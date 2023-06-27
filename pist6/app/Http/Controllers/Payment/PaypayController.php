<?php

namespace App\Http\Controllers\Payment;

use App\Helpers;
use App\Http\Controllers\Controller;
use App\Models\TicketOrder;
use App\Models\TicketOrderPayment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use tgMdk\dto\PaypayAuthorizeRequestDto;
use tgMdk\dto\PaypayAuthorizeResponseDto;
use tgMdk\TGMDK_AuthHashUtil;
use tgMdk\TGMDK_Config;
use tgMdk\TGMDK_Logger;
use tgMdk\TGMDK_Transaction;

class PaypayController extends Controller
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
     * (1) 「決済申込要求」と「結果応答」
     * を行う
     */
    public function paypayAuthorize(Request $request)
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
        $request_data       = new PaypayAuthorizeRequestDto();
        $param_request_data = self::setPaypayAuthorizeRequestParams($amount, $order_id);
        $request_data       = self::setPaypayAuthorizeRequestData($request_data, $param_request_data);
        $transaction        = new TGMDK_Transaction();
        $response_data      = $transaction->execute($request_data);

        if ( $response_data instanceof PaypayAuthorizeResponseDto ) {
            // 処理結果：正常終了
            if ( $response_data->getMstatus() === "success" ) {
                DB::beginTransaction();
                try {
                    // 新規登録（ticket_orders）
                    $param_ticket_order = self::generateTicketOrderParam($request, $amount, $this->TicketOrder);
                    $ticket_order = $this->TicketOrder->createTicketOrder($param_ticket_order);
                    // 新規登録（ticket_payments）
                    $param_ticket_payment = self::generateTicketOrderPaymentParam($ticket_order->id, $order_id, $this->TicketOrderPayment);
                    $ticket_payment = $this->TicketOrderPayment->create($param_ticket_payment);

                    DB::commit();

                    // (2) 「リダイレクト指示」: 金融機関選択画面
                    $responseContents = $response_data->getResponseContents();
                    header("Content-type: text/html; charset=Shift_JIS");
                    return response($responseContents);
                } catch (\Exception $e) {
                    DB::rollback();
                    Log::error($e->getMessage());
                    exit(config('payment.message.error.paypay.db.insert'));
                }

            // 処理結果：異常終了
            } else {
                $title = '決済リクエストエラー';
                $msg   = '決済内容送信時にエラーが発生しました。再度お試しください。';

                return view('payment.paypay.result', compact('title', 'msg'));
            }
        } else {
            exit(config('payment.message.error.paypay.bad_response'));
        }
    }

    /**
     * 結果
     */
    public function result(Request $request)
    {
        // ログの設定
        $logger = Log::channel('tgmdk')->getLogger();
        if ($logger instanceof LoggerInterface) {
            TGMDK_Logger::setLogger($logger);
        }
        
        $result             = $request->status;
        $veritrans_order_id = $request->orderId;

        if ( $result === 'success' ) {
            $title  = '決済完了';
            $msg    = '決済処理が完了しました。';
           
        } elseif ( $result === 'cancel' ) {
            $title = '決済キャンセル';
            $msg   = '決済処理がキャンセルされました。';

        } elseif ( $result === 'error' ) {
            $title = '連携エラー';
            $msg   = '決済処理時にエラーが発生しました。';

        } else {
            return redirect()->route('error',['body' => config('payment.message.error.paypay.bad_response')]);
        }

        // キャンセル場合のみDB更新
        // 正常終了またはエラー発生時は、PUSH通知によりDB更新を行う
        //  - PushController@paypay　を参照
        if ( $result === 'cancel' ) {
            DB::beginTransaction();
            try {
                $status = $this->TicketOrderPayment::STATUS_CANCEL;
                $this->TicketOrderPayment->updStatus($veritrans_order_id, $status);
                DB::commit();

                $status_name = $this->TicketOrderPayment::STATUS[$status];

                Log::debug(config('payment.message.success.paypay.db.update'));
                Log::debug('veritrans_order_id:' . $veritrans_order_id);
                Log::debug('status:[' . $status . '] ' . $status_name);

            } catch (\Exception $e) {
                DB::rollback();
                Log::error($e->getMessage());
                Log::error(config('payment.message.error.paypay.db.update'));
            }
        }

        return view('payment.paypay.result', compact('title', 'msg'));
    }


    /**
     * 「決済申込要求」パラメータ設定関数
     * 
     * @param string $amount
     * @param string $order_id
     * @return array $param_request_data
     */
    private static function setPaypayAuthorizeRequestParams($amount, $order_id)
    {
        return $param_request_data = [
            'order_id'            => $order_id,
            'service_option_type' => config('payment.common.paypay.service_option_type'),
            'accounting_type'     => config('payment.common.paypay.accounting_type'),
            'amount'              => $amount,
            'item_name'           => config('payment.common.paypay.item_name'),
            'item_id'             => config('payment.common.paypay.item_id'),
            'success_url'         => config('payment.common.paypay.success_url'),
            'cancel_url'          => config('payment.common.paypay.cancel_url'),
            'error_url'           => config('payment.common.paypay.error_url'),
            'push_url'            => config('payment.common.paypay.push_url'),
        ];
    }

    /**
     * 「決済申込要求」の設定
     *
     * @param PaypayAuthorizeRequestDto $request_data
     * @param array $param_request_data
     * @return PaypayAuthorizeRequestDto $request_data
     */
    private static function setPaypayAuthorizeRequestData($request_data, $param_request_data)
    {
        if ( $request_data instanceof PaypayAuthorizeRequestDto ) {
            $request_data->setOrderId($param_request_data['order_id']);
            $request_data->setServiceOptionType($param_request_data['service_option_type']);
            $request_data->setAccountingType($param_request_data['accounting_type']);
            $request_data->setAmount($param_request_data['amount']);
            $request_data->setItemName($param_request_data['item_name']);
            $request_data->setItemId($param_request_data['item_id']);
            $request_data->setSuccessUrl($param_request_data['success_url']);
            $request_data->setCancelUrl($param_request_data['cancel_url']);
            $request_data->setErrorUrl($param_request_data['error_url']);
            $request_data->setPushUrl($param_request_data['push_url']);
        } else {
            exit(config('payment.message.error.paypay.bad_request'));
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
            'method'             => $TicketOrderPayment::METHOD_PAYPAY,
            'status'             => $TicketOrderPayment::STATUS_ATTEMPT,
            'requested_at'       => Carbon::now(),
        ];
    }
}
