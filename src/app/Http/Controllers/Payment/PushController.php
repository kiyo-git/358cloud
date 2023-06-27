<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\TicketOrder;
use App\Models\TicketOrderPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use tgMdk\TGMDK_Exception;
use tgMdk\TGMDK_Logger;
use tgMdk\TGMDK_MerchantUtility;

class PushController extends Controller
{
    protected $TicketOrder;
    protected $TicketOrderPayment;

    public function __construct(TicketOrder $TicketOrder, TicketOrderPayment $TicketOrderPayment)
    {
        $this->TicketOrder   = $TicketOrder;
        $this->TicketOrderPayment = $TicketOrderPayment;
    }

    /**
     * ネットバンク 入金Push通知受信関数
     * @param Request $request
     * @return
     */
    public function netbank(Request $request)
    {
        $logger = Log::channel('tgmdk')->getLogger();
        if ($logger instanceof LoggerInterface) {
            TGMDK_Logger::setLogger($logger);
        }

        Log::debug('----netbank-push-recieved----');

        $body = $request->getContent();
        $hmac = $request->header('content-hmac');

        Log::debug('body:' . $body);
        Log::debug('content-hmac:' . $hmac);

        try {
            if (TGMDK_MerchantUtility::checkMessage($body, $hmac)) {
                Log::debug(config('payment.message.success.netbank.push'));
                DB::beginTransaction();
                try {
                    $body_array = self::arrangeBody($body);
                    $veritrans_order_id = $body_array['orderId0000'];

                    // user_idの取得と強制ログイン
                    $user_id  = $this->TicketOrderPayment->getUserIdByVeritransOrderId($veritrans_order_id)['user_id'];
                    Auth::loginUsingId($user_id, true);

                    $status_complete = $this->TicketOrderPayment::STATUS_COMPLETE;
                    $status_name     = $this->TicketOrderPayment::STATUS[$status_complete];
                    // 決済完了のステータスに変更
                    $this->TicketOrderPayment->updStatus($veritrans_order_id, $status_complete);

                    Log::debug(config('payment.message.success.netbank.db.update'));
                    Log::debug('veritrans_order_id:' . $veritrans_order_id);
                    Log::debug('status:[' . $status_complete . '] ' . $status_name);
                    Log::debug('----netbank-push-end----');

                    DB::commit();

                    return response('OK', 200);
                } catch (\Exception $e) {
                    DB::rollback();
                    Log::error($e->getMessage());
                    Log::error(config('payment.message.error.netbank.db.update'));
                }

            } else {
                Log::error(config('payment.message.error.netbank.push'));
                Log::debug('----netbank-push-end----');
            }

        } catch (TGMDK_Exception $e) {
            Log::error(config('payment.message.error.netbank.push'));
            Log::debug('----netbank-push-end----');
        }

        // ここではTicketOrderPaymentsに失敗を格納しない。
        // ※200以外を返した場合、Veritransから通知がリトライされる。

        return response('NG', 500);
    }

    /**
     * Paypay 入金Push通知受信関数
     * @param Request $request
     * @return
     */
    public function paypay(Request $request)
    {
        $logger = Log::channel('tgmdk')->getLogger();
        if ($logger instanceof LoggerInterface) {
            TGMDK_Logger::setLogger($logger);
        }

        Log::debug('----paypay-push-recieved----');

        $body = $request->getContent();
        $hmac = $request->header('content-hmac');

        Log::debug('body:' . $body);
        Log::debug('content-hmac:' . $hmac);

        try {
            if (TGMDK_MerchantUtility::checkMessage($body, $hmac)) {
                Log::debug(config('payment.message.success.paypay.push'));
                DB::beginTransaction();
                try {
                    $body_array = self::arrangeBody($body);
                    $veritrans_order_id = $body_array['orderId0000'];
                    $vResultCode = $body_array['vResultCode0000'];

                    // ステータス設定
                    $status      = $vResultCode == '1001' ? $this->TicketOrderPayment::STATUS_COMPLETE : $this->TicketOrderPayment::STATUS_FEDERATE_ERROR;
                    $status_name = $this->TicketOrderPayment::STATUS[$status];
                    // ステータス変更
                    $this->TicketOrderPayment->updStatus($veritrans_order_id, $status);

                    Log::debug(config('payment.message.success.paypay.db.update'));
                    Log::debug('veritrans_order_id:' . $veritrans_order_id);
                    Log::debug('status:[' . $status . '] ' . $status_name);
                    Log::debug('----paypay-push-end----');

                    DB::commit();

                    return response('OK', 200);
                } catch (\Exception $e) {
                    DB::rollback();
                    Log::error($e->getMessage());
                    Log::error(config('payment.message.error.paypay.db.update'));
                }

            } else {
                Log::error(config('payment.message.error.paypay.push'));
                Log::debug('----paypay-push-end----');
            }

        } catch (TGMDK_Exception $e) {
            Log::error(config('payment.message.error.paypay.push'));
            Log::debug('----paypay-push-end----');
        }

        // ここではTicketOrderPaymentsに失敗を格納しない。
        // ※200以外を返した場合、Veritransから通知がリトライされる。

        return response('NG', 500);
    }

    /**
     * $bodyを整形し、連想配列として返却する関数
     *
     * @param string $body 　　　　サンプル：'numberOfNotify=1&pushTime=20230519094049&pushId=00001025&orderId0000=dummy1684456824301&kikanNo0000=58191000&kigyoNo0000=21702&rcvDate0000=202305190940&customerNo0000=20001900030947960025&confNo0000=288916&rcvAmount0000=100&dummy0000=1'
     * @return array $body_array
     */
    private static function arrangeBody($body)
    {
        $body_exploded = explode('&', $body);
        foreach ($body_exploded as $component) {
            $component_pair = explode('=', $component);

            $body_array[$component_pair[0]] = $component_pair[1];
        }

        return $body_array;
    }

}
