<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Libs\Admin\DownloadPayment;
use App\Models\ChangeLog;
use App\Models\TicketOrder;
use App\Models\TicketOrderPayment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Psr\Log\LoggerInterface;
use tgMdk\dto\CommonSearchParameter;
use tgMdk\dto\SearchParameters;
use tgMdk\dto\SearchRequestDto;
use tgMdk\dto\SearchResponseDto;
use tgMdk\TGMDK_Logger;
use tgMdk\TGMDK_Transaction;

class PaymentSearchController extends Controller
{
    protected $TicketOrder;
    protected $TicketOrderPayment;
    protected $User;
    protected $ChangeLog;

    public function __construct(TicketOrder $TicketOrder, TicketOrderPayment $TicketOrderPayment, User $User, ChangeLog $ChangeLog)
    {
        $this->TicketOrder        = $TicketOrder;
        $this->TicketOrderPayment = $TicketOrderPayment;
        $this->User               = $User;
        $this->ChangeLog          = $ChangeLog;
    }

    /**
     * 一覧表示関数
     */
    public function index(Request $request)
    {
        try {
            $ticket_orders = $this->TicketOrder->getAllJoinedPaymentAndUsers();

            $params = $request->session()->exists('payment_search_params') ? $request->session()->get('payment_search_params') : self::getParams($search_flg = false);

            $veritrans_status = self::searchPaymentStatusMultiple($ticket_orders);
            $veritrans_order_status = $veritrans_status['veritrans_order_status'];
            $success_all = $veritrans_status['success_all'];
            // debug_mode
            // dd($params);

            return view('admin.payment.index', compact('ticket_orders', 'params', 'veritrans_order_status', 'success_all'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            exit(config('admin.message.error.payment.list'));
        }
    }

    /**
     * 編集画面の表示
     * @param Request $request
     */
    public function show(Request $request)
    {
        $id  = $request->route('id');

        try {
            $ticket_order = $this->TicketOrder->findJoinedPaymentAndUsers($id);
            $maybe_payment_status = self::searchPaymentStatus($ticket_order);

            // debug_mode
            // dd($ticket_order);

            return view('admin.payment.show', ['ticket_order' => $ticket_order, 'payment_status' => $maybe_payment_status['rows']]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            exit(config('admin.message.error.payment.show'));
        }
    }

    /**
     * 購入ステータスの更新
     * @param Request $request
     */
    public function updStatus(Request $request)
    {
        $attr = $request->only(['order_id', 'veritrans_order_id', 'status', 'remark']);

        try {
            $ticketOrderPayment = $this->TicketOrderPayment->select('id', 'status', 'remark')
                ->where('veritrans_order_id', $attr['veritrans_order_id'])
                ->firstOrFail();
            $ticketOrderPayment->status = $attr['status'];
            $ticketOrderPayment->remark = $attr['remark'];
            $upd_columns = $ticketOrderPayment->getDirty();
            $ticketOrderPayment->save();
            // 更新ログ登録
            $this->ChangeLog->createChangeLog($this->TicketOrderPayment->getTable(), $ticketOrderPayment->id, $this->ChangeLog::TYPE_UPDATE, $upd_columns);


            return redirect()->route('admin.payment.list', ['upd' => 'success']);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            exit(config('admin.message.error.payment.update'));
        }
    }

    /**
     * 条件検索
     * @param Request $request
     */
    public function search(Request $request)
    {
        $params = self::getParams($search_flg = true, $request);

        try {
            if ( $request->session()->exists('payment_search_params') ) {
                $request->session()->forget('payment_search_params');
            }
            $request->session()->put('payment_search_params', $params);

            // debug_mode
            // dd($request->session()->all());

            $ticket_orders = $this->TicketOrder
                                    ->getOrderListBySearch($params)
                                    ->orderBy('ticket_orders.id')->paginate(config('admin.common.pagination'));

            // debug_mode
            // dd($params);

            $veritrans_status = self::searchPaymentStatusMultiple($ticket_orders);
            $veritrans_order_status = $veritrans_status['veritrans_order_status'];
            $success_all = $veritrans_status['success_all'];

            return view('admin.payment.index', compact('ticket_orders', 'params', 'veritrans_order_status', 'success_all'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            exit(config('admin.message.error.payment.search'));
        }
    }

    /**
     * 検索条件クリア関数
     * @param Request $request
     */
    public function clear(Request $request)
    {
        try {
            if ( $request->session()->exists('payment_search_params') ) {
                $request->session()->forget('payment_search_params');
            }
            return redirect()->route('admin.payment.list');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            exit(config('admin.message.error.payment.clear'));
        }
    }

     /**
     * CSVダウンロード
     *
     * @return void
     */
    public function download(Request $request)
    {
        try {
            $param = $request->session()->get('payment_search_params');
            $Download = new DownloadPayment();
            return $Download->download($param);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            exit(config('admin.message.error.transfer_user_search.download'));
        }
    }

    /**
     * viewで使用する各パラメータ設定
     *
     * @param boolean $search_flg
     * @param object Request $request
     * @return array
     */
    private function getParams($search_flg, $request = null)
    {
        if ($search_flg) {
            return $request->only([
                'order_id',
                'veritrans_order_id',
                'user_id',
                'total_amount_min',
                'total_amount_max',
                'request_from',
                'request_to',
                'completed_from',
                'completed_to',
                'method',
                'status',
            ]);
        } else {
            return [
                'order_id'             => '',
                'veritrans_order_id'   => '',
                'user_id'              => '',
                'total_amount_min'     => '',
                'total_amount_max'     => '',
                'request_from'         => '',
                'request_to'           => '',
                'completed_from'       => '',
                'completed_to'         => '',
                'method'               => '',
                'status'               => '',
            ];
        }
    }

    private static function searchPaymentStatusMultiple($ticket_orders) {
        $veritrans_order_status = [];
        $success_all = [];

        foreach ($ticket_orders->toArray()['data'] as $ticket_order) {
            $payment_status = self::searchPaymentStatus($ticket_order);
            $search_result = $payment_status['rows'];

            foreach ($search_result as $search_result_row) {

                $veritrans_order_status[$ticket_order['ticket_order_id']] = $payment_status['veritrans_order_status'];
                $success_all[$ticket_order['ticket_order_id']] =
                    $search_result_row['result_is_success1'] &&
                    $search_result_row['result_is_success2'] &&
                    $search_result_row['result_is_success3'] &&
                    $search_result_row['result_is_success4'];
            }
        }

        return [
            'veritrans_order_status' => $veritrans_order_status,
            'success_all' => $success_all,
        ];
    }

    private static function searchPaymentStatus($ticket_order) {
        $logger = Log::channel('tgmdk')->getLogger();
        if ($logger instanceof LoggerInterface) {
            TGMDK_Logger::setLogger($logger);
        }

        // (5) 「結果確認」と「応答」
        $request_data  = new SearchRequestDto();
        $search_params = new SearchParameters();
        $common_search_params = new CommonSearchParameter();
        $common_search_params->setOrderId($ticket_order['veritrans_order_id']);
        $search_params->setCommon($common_search_params);
        $request_data->setSearchParameters($search_params);

        // ローカルとステージングの場合はダミーも検索
        if (App::environment('local', 'staging')) {
            $request_data->setContainDummyFlag(true);
        }

        $transaction   = new TGMDK_Transaction();
        $response_data = $transaction->execute($request_data);

        if ( $response_data instanceof SearchResponseDto ) {
            // 「結果確認」の処理自体の成否を確認する
            if ( $response_data->getMstatus() === 'success') {
                // 「結果確認」が成功の場合

                // トランザクション情報を抽出する
                $orderInfo = $response_data->getOrderInfos()->getOrderInfo();
                $rows = [];

                if (count($orderInfo) > 0) {
                    $transactions = $orderInfo[0]->getTransactionInfos();
                    $service_type_cd = $orderInfo[0]->getServiceTypeCd();
                    foreach ($transactions->getTransactionInfo() as $transaction) {
                        $vResultCode = $transaction->getVResultCode();
                        $vResultCode1 = substr($vResultCode, 0, 4);
                        $vResultCode2 = substr($vResultCode, 4, 4);
                        $vResultCode3 = substr($vResultCode, 8, 4);
                        $vResultCode4 = substr($vResultCode, 12, 4);

                        $result_detail1 = config('admin.veritrans_result.' . $vResultCode1) ?? array('success', '（なし）');
                        $result_detail2 = config('admin.veritrans_result.' . $vResultCode2) ?? array('success', '（なし）');
                        $result_detail3 = config('admin.veritrans_result.' . $vResultCode3) ?? array('success', '（なし）');
                        $result_detail4 = config('admin.veritrans_result.' . $vResultCode4) ?? array('success', '（なし）');

                        if ($service_type_cd == 'bank') {
                            $title_detail = config('admin.message.code.pe_txn_type.' . $transaction->getProperTransactionInfo()->getPeTxnType());
                        } else {
                            $title_detail = config('admin.message.code.command_card.' . $title_detail = $transaction->getCommand());
                        }

                        $rows[] = [
                            'title_detail' => $title_detail,
                            'vresultcode1' => $vResultCode1,
                            'vresultcode2' => $vResultCode2,
                            'vresultcode3' => $vResultCode3,
                            'vresultcode4' => $vResultCode4,
                            'result_is_success1' => $result_detail1[0] === 'success',
                            'result_is_success2' => $result_detail2[0] === 'success',
                            'result_is_success3' => $result_detail3[0] === 'success',
                            'result_is_success4' => $result_detail4[0] === 'success',
                            'message1' => $result_detail1[1],
                            'message2' => $result_detail2[1],
                            'message3' => $result_detail3[1],
                            'message4' => $result_detail4[1],
                        ];
                    }
                }

                return [
                    'veritrans_order_status' => count($orderInfo) > 0 ? TicketOrderPayment::VERITRANS_ORDER_STATUS[$orderInfo[0]->getOrderStatus()] : '(不明)',
                    'rows' => $rows,
                ];
            } else {
                // 「結果確認」の処理自体が失敗している場合
                Log::error($response_data->getVResultCode());
                throw new \Exception($response_data->getVResultCode());
            }
        } else {
            Log::error(config('admin.message.error.payment.veritrans_status'));
            throw new \Exception(config('admin.message.error.payment.veritrans_status'));
        }
    }

}
