<?php

namespace App\Libs\Admin;

use App\Models\TicketOrder;
use App\Models\TicketOrderPayment;

class DownloadPayment {
    /**
     * ダウンロード実行
     *
     * @return void
     */
    public function download($param)
    {
        $callback = function () use ($param) {
            $stream = fopen('php://output', 'w');

            stream_filter_prepend($stream, 'convert.iconv.utf-8/cp932//TRANSLIT');

            fputcsv($stream, $this->getPaymentsHeader());

            $TicketOrder = new TicketOrder();
            $ticket_orders = $TicketOrder->getOrderListBySearch($param)->orderBy('ticket_orders.id')->get();

            foreach ($ticket_orders as $order) {
                fputcsv($stream, $this->setPaymentsData($order));
            }
            fclose($stream);
        };

        $filename = 'payments.csv';

        $header = [
            'Content-Type' => 'application/octet-stream',
        ];

        // return $callback;
        return response()->streamDownload($callback, $filename, $header);
    }

    /**
     * paymentCSVヘッダー
     *会員ID｜購入ID｜決済ID | 決済金額｜決済手段 | 購入依頼日｜決済完了日
     * @return array
     */
    private function getPaymentsHeader()
    {
        return [
             '会員ID'//user_id
            , '購入ID'//ticket_order_id
            , '決済ID'//veritrans_order_id
            , '決済金額'//total_amount
            , '決済手段'//method
            , '購入依頼日'//requested_at
            , '決済完了日'//completed_at
        ];
    }

    /**
     * payment CSV値
     *
     * @param object $user
     * @return array
     */
    private function setPaymentsData($order)
    {
        return [
            $order->user_id
            ,$order->ticket_order_id
            ,$order->veritrans_order_id
            ,$order->total_amount
            ,TicketOrderPayment::METHOD[$order->method]
            ,$order->requested_at
            ,$order->completed_at
        ];
    }
}
