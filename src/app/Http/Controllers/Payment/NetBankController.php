<?php

namespace App\Http\Controllers\Payment;

use App\Helpers;
use App\Http\Controllers\Controller;
use App\Models\TicketOrder;
use App\Models\TicketOrderPayment;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Psr\Log\LoggerInterface;
use tgMdk\dto\BankAuthorizeRequestDto;
use tgMdk\dto\BankAuthorizeResponseDto;
use tgMdk\TGMDK_AuthHashUtil;
use tgMdk\TGMDK_Config;
use tgMdk\TGMDK_Logger;
use tgMdk\TGMDK_Transaction;

/**
 * [参照]
 * VeriTrans4G 開発ガイド別冊 概略システムフロー図
 * - (P.9) ネットバンク決済・PC [銀行リンク方式－決済機関コード未指定時]
 */
class NetBankController extends Controller
{
    protected $TicketOrder;
    protected $TicketOrderPayment;

    public function __construct(TicketOrder $TicketOrder, TicketOrderPayment $TicketOrderPayment)
    {
        $this->TicketOrder   = $TicketOrder;
        $this->TicketOrderPayment = $TicketOrderPayment;
    }

    /**
     * 「決済申込部」関数
     * (1) 「決済申込要求」と「決済申込応答」
     * (2) 「リダイレクト指示」: 金融機関選択画面
     * を行う
     *
     * @param Request $request
     * @return void
     */
    public function netbankAuthorize(Request $request)
    {
        // ログの設定
        $logger = Log::channel('tgmdk')->getLogger();
        if ($logger instanceof LoggerInterface) {
            TGMDK_Logger::setLogger($logger);
        }

        // debug_mode
        $amount   = '100';
        $order_id = Helpers::generateOrderId();
        // (1) 「決済申込要求」と「決済申込応答」
        $request_data       = new BankAuthorizeRequestDto();
        $param_request_data = self::setBankAuthorizeRequestParams($amount, $order_id);
        $request_data       = self::setBankAuthorizeRequestData($request_data, $param_request_data);
        $transaction        = new TGMDK_Transaction();
        $response_data      = $transaction->execute($request_data);

        if ( $response_data instanceof BankAuthorizeResponseDto ) {
            DB::beginTransaction();
            try {
                // 新規登録（ticket_orders）
                $param_ticket_order = self::generateTicketOrderParam($request, $amount, $this->TicketOrder);
                $ticket_order = $this->TicketOrder->createTicketOrder($param_ticket_order);
                // 新規登録（ticket_payments）
                $param_ticket_payment = self::generateTicketOrderPaymentParam($ticket_order->id, $order_id, $this->TicketOrderPayment);

                if ( $response_data->getMstatus() === "success" ) {
                    // 処理結果：正常終了（決済ではなく、API自体の処理結果）

                    $ticket_payment = $this->TicketOrderPayment->create($param_ticket_payment);
                    DB::commit();

                    // (2) 「リダイレクト指示」: 金融機関選択画面
                    return redirect()->away($response_data->getUrl());

                } else {
                    // 処理結果：異常終了（決済ではなく、API自体の処理結果。こちらに来る場合、Veritransに履歴が残らない。

                    $param_ticket_payment['status'] = $this->TicketOrderPayment::STATUS_FEDERATE_ERROR;
                    $ticket_payment = $this->TicketOrderPayment->create($param_ticket_payment);
                    DB::commit();

                    return view('payment.netbank.thanks')->with([
                        'mErrMsg' => $response_data->getMerrMsg(),
                    ]);
                }

            } catch (\Exception $e) {
                // DB更新に失敗した場合
                DB::rollback();
                Log::error($e->getMessage());
                exit(config('payment.message.error.netbank.db.insert'));
            }
        } else {
            // レスポンスが異常な場合。
            // todo: 「連携エラー」をDBに入れる方が適切な気がする。設計書がどうなっているか確認すること。
            exit(config('payment.message.error.netbank.bad_response'));
        }
    }

    /**
     * thanks画面表示関数
     */
    public function thanks()
    {
        return view('payment.netbank.thanks');
    }

    /**
     * 「決済申込要求」パラメータの設定関数
     *
     * @param string $amount
     * @param string $order_id
     * @return array $param_request_data
     */
    private static function setBankAuthorizeRequestParams($amount, $order_id)
    {
        // debug_mode
        $user = auth()->user();
        $name      = $user->family_name . '　' . $user->given_name;
        $name_kana = $user->family_name_kana . $user->given_name_kana;
        // $name      = '検証　太郎';
        // $name_kana = 'ケンショウタロウ';

        return $param_request_data = [
            'service_option_type' => config('payment.common.netbank.service_option_type'),
            'order_id'            => $order_id,
            'amount'              => $amount,
            'client_name1'        => $name,
            'client_kana1'        => $name_kana,
            'payment_limit'       => date('Ymd', strtotime('+30 min')),
            'contents'            => config('payment.common.netbank.contents'),
            'contents_kana'       => config('payment.common.netbank.contents_kana'),
            'term_url'            => config('payment.common.netbank.term_url'),
            'push_url'            => config('payment.common.netbank.push_url'),
        ];
    }

    /**
     * 「決済申込要求」の設定
     *
     * @param BankAuthorizeRequestDto $request_data
     * @param array $param_request_data
     * @return BankAuthorizeRequestDto $request_data
     */
    private static function setBankAuthorizeRequestData($request_data, $param_request_data)
    {
        if ( $request_data instanceof BankAuthorizeRequestDto ) {
            $request_data->setServiceOptionType($param_request_data['service_option_type']);
            $request_data->setOrderId($param_request_data['order_id']);
            $request_data->setAmount($param_request_data['amount']);
            $request_data->setName1($param_request_data['client_name1']);
            $request_data->setKana1($param_request_data['client_kana1']);
            $request_data->setPayLimit($param_request_data['payment_limit']);
            $request_data->setContents($param_request_data['contents']);
            $request_data->setContentsKana($param_request_data['contents_kana']);
            $request_data->setTermUrl($param_request_data['term_url']);
            $request_data->setPushUrl($param_request_data['push_url']);
        } else {
            exit(config('payment.message.error.netbank.bad_request'));
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
            'method'             => $TicketOrderPayment::METHOD_NETBANK,
            'status'             => $TicketOrderPayment::STATUS_ATTEMPT,
            'requested_at'       => Carbon::now(),
        ];
    }
}
