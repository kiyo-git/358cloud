<?php

namespace App\Http\Controllers\Payment;

use App\Helpers;
use App\Http\Controllers\Controller;
use App\Models\TicketOrder;
use App\Models\TicketOrderPayment;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Factory;
use Illuminate\View\View;
use Psr\Log\LoggerInterface;
use tgMdk\dto\CardInfoDeleteRequestDto;
use tgMdk\dto\CardInfoDeleteResponseDto;
use tgMdk\dto\CardInfoGetRequestDto;
use tgMdk\dto\CardInfoGetResponseDto;
use tgMdk\dto\MpiAuthorizeRequestDto;
use tgMdk\dto\MpiAuthorizeResponseDto;
use tgMdk\dto\MpiGetResultRequestDto;
use tgMdk\dto\MpiGetResultResponseDto;
use tgMdk\TGMDK_AuthHashUtil;
use tgMdk\TGMDK_Config;
use tgMdk\TGMDK_Logger;
use tgMdk\TGMDK_Transaction;


/**
 * [参照]
 * VeriTrans4G 開発ガイド別冊 概略システムフロー図
 * - (P.6) 3D セキュア（本人認証）利用時の処理
 */
class MpiController extends Controller
{
    protected $TicketOrder;
    protected $TicketOrderPayment;

    public function __construct(TicketOrder $TicketOrder, TicketOrderPayment $TicketOrderPayment)
    {
        $this->TicketOrder        = $TicketOrder;
        $this->TicketOrderPayment = $TicketOrderPayment;
    }

    /**
     * クレジットカード情報入力画面の表示
     */
    public function index()
    {
        // ログの設定
        $logger = Log::channel('tgmdk')->getLogger();
        if ($logger instanceof LoggerInterface) {
            TGMDK_Logger::setLogger($logger);
        }

        $request_data = new CardInfoGetRequestDto();

        $request_data->setAccountId(self::generateAccountId());
        $request_data->setCardNumberMaskType(config('payment.common.mpi.card_number_mask_type'));

        $transaction   = new TGMDK_Transaction();
        $response_data = $transaction->execute($request_data);
        if ($response_data instanceof CardInfoGetResponseDto) {
            // 処理結果：正常終了
            if ( $response_data->getMstatus() === 'success') {
                $cards = $response_data->getPayNowIdResponse()->getAccount()->getCardInfo();
            }

            return view('payment.mpi.index')->with(
                [
                    'tokenApiKey' => config('payment.common.token.token_api_key'),
                    "amount"      => "100",
                    "orderId"     => Helpers::generateOrderId(),
                    "cards"       => $cards ?? [], // 既存カードがない場合$cardsはnullになるため[]を合体
                ]);
        } else {
            Log::error(config('payment.message.error.mpi.bad_response'));
            exit(config('payment.message.error.mpi.bad_response'));
        }
    }

    /**
     * 「決済処理開始」関数
     * (1) 「認可要求」と「応答」
     * (2) 「リダイレク指示」
     * を行う
     *
     * @param Request $request
     * @return void | Response | Factory
     */
    public function mpiAuthorize(Request $request)
    {
        // ログの設定
        $logger = Log::channel('tgmdk')->getLogger();
        if ($logger instanceof LoggerInterface) {
            TGMDK_Logger::setLogger($logger);
        }

        $amount             = $request->request->get("amount");
        $order_id           = $request->request->get("orderId");
        // (1) 「認可要求」と「応答」
        $request_data       = self::generateMpiAuthorizeRequestDto($request);
        $transaction        = new TGMDK_Transaction();
        $response_data      = $transaction->execute($request_data);

        if ( $response_data instanceof MpiAuthorizeResponseDto ) {
            DB::beginTransaction();
            try {
                // 新規登録（ticket_orders）
                $param_ticket_order   = self::generateTicketOrderParam($request, $amount, $this->TicketOrder);
                $ticket_order         = $this->TicketOrder->createTicketOrder($param_ticket_order);
                // 新規登録（ticket_payments）
                $param_ticket_payment = self::generateTicketOrderPaymentParam($ticket_order->id, $order_id, $this->TicketOrderPayment);

                if ($response_data->getMstatus() == "success") {
                    // 処理結果：正常終了（決済ではなく、API自体の処理結果）

                    $ticket_payment = $this->TicketOrderPayment->create($param_ticket_payment);
                    DB::commit();
                    // (2) 「リダイレク指示」
                    // メモVeritrans側で生成されたHTMLページを返している。
                    // そのページを挟んでからrelayのページに遷移している。
                    return response($response_data->getResResponseContents());
                } else {
                    // 処理結果：異常終了（決済ではなく、API自体の処理結果。こちらに来る場合、Veritransに履歴が残らない。

                    $param_ticket_payment['status'] = $this->TicketOrderPayment::STATUS_FEDERATE_ERROR;
                    $ticket_payment = $this->TicketOrderPayment->create($param_ticket_payment);
                    DB::commit();

                    return view('payment.mpi.result')->with([
                        'mErrMsg' => $response_data->getMerrMsg(),
                    ]);
                }
            } catch (\Exception $e) {
                // DB更新に失敗した場合
                DB::rollback();
                Log::error($e->getMessage());
                exit(config('payment.message.error.mpi.db.insert'));
            }
        } else {
            // レスポンスが異常な場合。
            Log::error(config('payment.message.error.mpi.bad_response'));
            exit(config('payment.message.error.mpi.bad_response'));
        }
    }

    /**
     * 「決済完了処理」関数
     * (4) 「結果連携」：「Request $request」
     */
    public function relay(Request $request)
    {
        $logger = Log::channel('tgmdk')->getLogger();
        if ($logger instanceof LoggerInterface) {
            TGMDK_Logger::setLogger($logger);
        }

        try {
            // veritrans_order_idの取得
            $order_id = $request->request->get("OrderId");
            // user_idの取得と強制ログイン
            $user_id  = $this->TicketOrderPayment->getUserIdByVeritransOrderId($order_id)['user_id'];
            Auth::loginUsingId($user_id, true);
            // 結果の確認とDBのstatus更新
            $response = $this->result($order_id);

            if ( $response === 'success' ) {
                return view('payment.mpi.result');
            } else {
                return view('payment.mpi.result')->with([
                    'mErrMsg' => $response,
                ]);
            }

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            exit(config('payment.message.error.mpi.bad_notification'));
        }
    }

    /**
     * (5) 「結果確認」と「応答」
     * DBのstatus更新
     * 結果ページの送信
     * を行う
     */
    public function result($order_id)
    {
        $logger = Log::channel('tgmdk')->getLogger();
        if ($logger instanceof LoggerInterface) {
            TGMDK_Logger::setLogger($logger);
        }

        // (5) 「結果確認」と「応答」
        $request_data  = new MpiGetResultRequestDto();
        $request_data->setOrderId($order_id);
        $transaction   = new TGMDK_Transaction();
        $response_data = $transaction->execute($request_data);

        if ( $response_data instanceof MpiGetResultResponseDto ) {

            // 「結果確認」の処理自体の成否を確認する
            if ( $response_data->getMstatus() === 'success') {
                // 本人認証とカード決済の成否を確認する
                if ($response_data->getMpiMstatus() === 'success' && $response_data->getCardMstatus() === 'success') {
                    // 決済成功の場合
                    $status = $this->TicketOrderPayment::STATUS_COMPLETE;
                    $function_result = 'success';
                } else {
                    // 決済失敗の場合
                    Log::error($response_data->getMpiVResultCode());

                    // 本当に失敗なのか、「成功かもしれない失敗」なのかの判別
                    if (self::maybeVeritransCompleted($response_data->getMpiVResultCode())) {
                        $status = $this->TicketOrderPayment::STATUS_FEDERATE_ERROR;
                    } else {
                        $status = $this->TicketOrderPayment::STATUS_ERROR;
                    }

                    $function_result = '決済に失敗しました。';
                }
            } else {
                // 「結果確認」の処理自体が失敗している場合
                Log::error($response_data->getVResultCode());
                $status = $this->TicketOrderPayment::STATUS_FEDERATE_ERROR;
                $function_result = $response_data->getMerrMsg();
            }

            DB::beginTransaction();
            try {
                // DB更新
                $this->TicketOrderPayment->updStatus($order_id, $status);
                DB::commit();

                return $function_result;
            } catch (\Exception $e) {
                // DB更新に失敗した場合
                DB::rollback();
                Log::error($e->getMessage());
                exit(config('payment.message.error.mpi.db.update'));
            }
        } else {
            // レスポンスが異常な場合。
            // todo: 「連携エラー」をDBに入れる方が適切な気がする。設計書がどうなっているか確認すること。
            exit(config('payment.message.error.mpi.bad_response'));
        }

    }

    /**
     * 「カード情報削除」関数
     * 継続課金機能を通して登録されたカードを削除する。
     */
    public function removeCard(Request $request)
    {
        $logger = Log::channel('tgmdk')->getLogger();
        if ($logger instanceof LoggerInterface) {
            TGMDK_Logger::setLogger($logger);
        }

        $request_data = new CardInfoDeleteRequestDto();
        $request_data->setAccountId(self::generateAccountId());
        $request_data->setCardId($request->request->get('card_id'));

        $transaction   = new TGMDK_Transaction();
        $response_data = $transaction->execute($request_data);

        if ( $response_data instanceof CardInfoDeleteResponseDto) {
            // 処理結果：正常終了
            if ( $response_data->getMstatus() === 'success') {
                return json_encode(["message" => config('payment.message.success.mpi.card_remove')]);
            // 処理結果：異常終了
            } else {
                Log::error($response_data->getMerrMsg());
                return response()->json(["message" => config('payment.message.error.mpi.card_remove')], 500);
            }
        } else {
            return json_encode(["message" => config('payment.message.error.mpi.card_remove')]);
        }
    }

    /**
     *  「認可要求」パラメータの設定関数
     *
     * @param Request $request
     * @return MpiAuthorizeRequestDto $request_data
     */
    private static function generateMpiAuthorizeRequestDto($request) {
        $request_data = new MpiAuthorizeRequestDto();
        $request_data->setHttpAccept($request->header('Accept'));
        $request_data->setHttpUserAgent($request->header('User-Agent'));
        $request_data->setAmount($request->request->get('amount'));
        $request_data->setOrderId($request->request->get('orderId'));
        $request_data->setJpo(config('payment.common.mpi.jpo'));
        $request_data->setWithCapture(config('payment.common.mpi.with_capture'));
        $request_data->setServiceOptionType(config('payment.common.mpi.service_option_type'));
        $request_data->setRedirectionUri(config('payment.common.mpi.redirection_url'));
        $request_data->setVerifyTimeout(config('payment.common.mpi.verify_timeout'));
        $request_data->setDeviceChannel(config('payment.common.mpi.device_channel'));
        $request_data->setAccountId(self::generateAccountId());

        // 以下、新しいカードの場合と既存カードの場合に分岐
        $cardId = $request->request->get('cardId');
        if ($cardId == 'newCard') {
            // 新しいカードの場合、トークンを渡す
            $request_data->setToken($request->request->get("token"));
        } else {
            // 既存カードの場合、カードIDを渡す
            $request_data->setCardId($cardId);
        }

        return $request_data;
    }

    /**
     * 「ticket_orders」テーブルに挿入する項目の設定
     *
     * @param Request $request
     * @param string $amount
     * @param TicketOrder $TicketOrder
     * @return array $param_ticket_order
     */
    private static function generateTicketOrderParam($request, $amount, $TicketOrder)
    {
        return $param_ticket_order = [
            'user_id'           => auth()->id(),
            // 'user_id'           => 1,
            'subtotal_amount'   => 100, // $requestから取得
            'campaign_discount' => 0,   // $requestから取得
            'coupon_discount'   => 0,   // $requestから取得
            'option_discount'   => 0,   // $requestから取得
            'total_amount'      => $amount,
            'is_replaced'       => $TicketOrder::IS_REPLACED_FALSE,
        ];
    }

    /**
     * 「ticket_payments」テーブルに挿入する項目の設定
     *
     * @param integer $ticket_orders_id
     * @param string $veritrans_order_id
     * @param TicketOrderPayment $TicketOrderPayment
     * @return array $param_ticket_payment
     */
    private static function generateTicketOrderPaymentParam($ticket_orders_id, $veritrans_order_id, $TicketOrderPayment)
    {
        return $param_ticket_payment = [
            'ticket_order_id'    => $ticket_orders_id,
            'veritrans_order_id' => $veritrans_order_id,
            'method'             => $TicketOrderPayment::METHOD_MPI,
            'status'             => $TicketOrderPayment::STATUS_ATTEMPT,
            'requested_at'       => Carbon::now(),
        ];
    }

    /**
     * Veritransに連携する会員IDの設定
     * @return string
     */
    private static function generateAccountId()
    {
        return config('payment.common.mpi.account_id_prefix') . auth()->id();
    }

    private static function maybeVeritransCompleted($vresultcode) {
        $vResultCode1 = substr($vresultcode, 0, 4);
        $vResultCode2 = substr($vresultcode, 4, 4);
        $vResultCode3 = substr($vresultcode, 8, 4);
        $vResultCode4 = substr($vresultcode, 12, 4);

        // ドキュメント「決済結果コード一覧」を参照
        return
            in_array($vResultCode1, ['MA99', 'MB03', 'MB99', 'MF01', 'MF02', 'MF03', 'MF04', 'MF99']) ||
            in_array($vResultCode2, ['MA99', 'MB03', 'MB99', 'MF01', 'MF02', 'MF03', 'MF04', 'MF99']) ||
            in_array($vResultCode3, ['MA99', 'MB03', 'MB99', 'MF01', 'MF02', 'MF03', 'MF04', 'MF99']) ||
            in_array($vResultCode4, ['MA99', 'MB03', 'MB99', 'MF01', 'MF02', 'MF03', 'MF04', 'MF99']);
    }
}
