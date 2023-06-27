<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketOrder extends Model
{
    use HasFactory;

    protected $table = 'ticket_orders';

    protected $guarded = [
        'id',
        'canceled_at',
    ];

    const IS_REPLACED_FALSE = 0;
    const IS_REPLACED_TRUE  = 1;

    const IS_REPLACED = [
        self::IS_REPLACED_FALSE => '移行前',
        self::IS_REPLACED_TRUE  => '移行後',
    ];

    /**
     * id検索
     * @param string $id
     */
    public function findTicketOrder($id)
    {
        return $this->find($id);
    }

    /**
     * id検索
     * 「ticket_order_payments」と「users」を結合
     */
    public function findJoinedPaymentAndUsers($id)
    {
        return $this->leftJoin('ticket_order_payments', 'ticket_orders.id', '=', 'ticket_order_payments.ticket_order_id')
                    ->leftJoin('users', 'ticket_orders.user_id', '=', 'users.id')
                    ->find($id);
    }

    /**
     * 全件取得
     */
    public function getAllTicketOrder()
    {
        return $this->orderBy('id', 'desc')->get();
    }

    /**
     * 全件取得
     * 「ticket_order_payments」と「users」を結合
     */
    public function getAllJoinedPaymentAndUsers()
    {
        return $this->leftJoin('ticket_order_payments', 'ticket_orders.id', '=', 'ticket_order_payments.ticket_order_id')
                    ->leftJoin('users', 'ticket_orders.user_id', '=', 'users.id')
                    ->orderBy('ticket_orders.id', 'desc')
                    ->paginate(config('admin.common.pagination'));
    }

    /**
     * 新規レコードの作成
     * @param array $param
     */
    public function createTicketOrder($param)
    {
        return $this->create($param);
    }

    /**
     * 管理画面の「購入履歴」検索用関数
     * @param array $params
     * @return object $ticket_orders
     */
    public function getOrderListBySearch($params)
    {
        // debug_mode
        // dd($params);

        // self::JoinedTable($params);

        // 初期クエリ
        $ticket_orders = $this->query();
        // どのような$paramsが渡されても「ticket_order_payments」は結合
        $ticket_orders->Join('ticket_order_payments', 'ticket_orders.id', '=', 'ticket_order_payments.ticket_order_id');

        /**
         * 条件追加
         */
        // 購入ID
        if (isset($params['order_id'])) $ticket_orders->where('ticket_orders.id', 'LIKE', '%' . addcslashes($params['order_id'], '%_\\') . '%');

        // 決済ID
        if (isset($params['veritrans_order_id'])) $ticket_orders->Join('ticket_order_payments as payments_veritrans', 'ticket_orders.id', '=', 'payments_veritrans.ticket_order_id')->where('payments_veritrans.veritrans_order_id', 'LIKE', '%' . addcslashes($params['veritrans_order_id'], '%_\\') . '%');

        // ユーザーID
        if (isset($params['user_id'])) $ticket_orders->Join('users', 'users.id', '=', 'ticket_orders.user_id')->where('users.id', 'LIKE', '%' . addcslashes($params['user_id'], '%_\\') . '%');

        // 決済金額
        if (isset($params['total_amount_min'])) {
            $ticket_orders->where('total_amount', '>=', addcslashes($params['total_amount_min'], '%_\\'));
        }
        if (isset($params['total_amount_max'])) {
            $ticket_orders->where('total_amount', '<=', addcslashes($params['total_amount_max'], '%_\\'));
        }

        // 購入依頼日時
        if (isset($params['request_from'])) {
            $params['request_from'] .= ' 00:00:00';
            $ticket_orders->Join('ticket_order_payments as payments_request_from', 'ticket_orders.id', '=', 'payments_request_from.ticket_order_id')->where('payments_request_from.requested_at', '>=', addcslashes($params['request_from'], '%_\\'));
        }
        if (isset($params['request_to'])) {
            $params['request_to']   .= ' 23:59:59';
            $ticket_orders->Join('ticket_order_payments as payments_request_to', 'ticket_orders.id', '=', 'payments_request_to.ticket_order_id')->where('payments_request_to.requested_at', '<=', addcslashes($params['request_to'], '%_\\'));
        }

        // 決済完了日時
        if (isset($params['completed_from'])) {
            $params['completed_from'] .= ' 00:00:00';
            $ticket_orders->Join('ticket_order_payments as payments_completed_from', 'ticket_orders.id', '=', 'payments_completed_from.ticket_order_id')->where('payments_completed_from.completed_at', '>=', addcslashes($params['completed_from'], '%_\\'));
        }
        if (isset($params['completed_to'])) {
            $params['completed_to']   .= ' 23:59:59';
            $ticket_orders->Join('ticket_order_payments as payments_completed_to', 'ticket_orders.id', '=', 'payments_completed_to.ticket_order_id')->where('payments_completed_to.completed_at', '<=', addcslashes($params['completed_to'], '%_\\'));
        }

        // 支払い方法
        if (isset($params['method'])) $ticket_orders->Join('ticket_order_payments as payments_method', 'ticket_orders.id', '=', 'payments_method.ticket_order_id')->where('payments_method.method', '=', addcslashes($params['method'], '%_\\'));

        // 購入ステータス
        if (isset($params['status'])) $ticket_orders->Join('ticket_order_payments as payments_status', 'ticket_orders.id', '=', 'payments_status.ticket_order_id')->where('payments_status.status', '=', addcslashes($params['status'], '%_\\'));

        return $ticket_orders;
    }
}
