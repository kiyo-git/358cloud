<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class TicketOrderPayment extends Model
{
    use HasFactory;

    protected $table = 'ticket_order_payments';

    protected $guarded = ['id'];

    const METHOD_MPI     = 1;
    const METHOD_PAYPAY  = 2;
    const METHOD_NETBANK = 3;

    const METHOD = [
        self::METHOD_MPI     => 'クレジット（3D認証）',
        self::METHOD_PAYPAY  => 'PayPay',
        self::METHOD_NETBANK => 'ネットバンク',
    ];

    const STATUS_ATTEMPT           = 1;
    const STATUS_COMPLETE          = 2;
    const STATUS_OVERTIME          = 3;
    const STATUS_ERROR             = 4;
    const STATUS_FEDERATE_ERROR    = 5;
    const STATUS_CANCEL            = 6;

    const STATUS = [
        self::STATUS_ATTEMPT        => '購入可能',
        self::STATUS_COMPLETE       => '購入完了',
        self::STATUS_OVERTIME       => '購入時間超過',
        self::STATUS_ERROR          => '購入エラー',
        self::STATUS_FEDERATE_ERROR => '連携エラー',
        self::STATUS_CANCEL         => '購入キャンセル',
    ];

    const VERITRANS_ORDER_STATUS = [
        'initial'          => '初期状態',
        'end'              => '終了',
        'end_presentation' => '画面遷移正常終了',
        'pending'          => '保留',
        'validation_error' => '検証エラー',
        'expired'          => '期限切れ',
        'error'            => 'エラー',
    ];

    public function find($id)
    {
        return $this->find($id);
    }

    public function getAll()
    {
        return $this->orderBy('id', 'desc')->get();
    }

    public function updStatus($veritrans_order_id, $status)
    {
        $ticketOrderPayment = $this->select('id', 'status')
                                ->where('veritrans_order_id', $veritrans_order_id)
                                ->firstOrFail();
        $ticketOrderPayment->status = $status;

        if ($status == self::STATUS_COMPLETE) {
            $ticketOrderPayment->completed_at = Carbon::now();
        }

        return $ticketOrderPayment->save();
    }

    public function getUserIdByVeritransOrderId($veritrans_order_id)
    {
        return $this->select('ticket_orders.user_id')
                    ->join('ticket_orders', 'ticket_order_payments.ticket_order_id', '=', 'ticket_orders.id')
                    ->where('ticket_order_payments.veritrans_order_id', $veritrans_order_id)
                    ->firstOrFail();
    }

    // 購入時間超過
    public function getTimeouted()
    {
        return $this->whereDate('created_at', '<=', Carbon::now()->subHours(24))->where('status', self::STATUS_ATTEMPT);
    }
}
