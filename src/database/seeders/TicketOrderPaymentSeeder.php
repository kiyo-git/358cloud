<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TicketOrderPaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ticket_order_payments = [
            [
                'ticket_order_id'=>1,
                'veritrans_order_id'=>'dummy1686303320610',
                'method'=>1,
                'status'=>5,
                'remark'=>null,
                'requested_at'=>Carbon::now(),
                'completed_at' => null,
                'created_at'     => Carbon::now(),
                'updated_at'     => Carbon::now(),
            ],
            [
                'ticket_order_id'=>2,
                'veritrans_order_id'=>'dummy1686303369555',
                'method'=>1,
                'status'=>2,
                'remark'=>null,
                'requested_at'=>Carbon::now(),
                'completed_at' => Carbon::now(),
                'created_at'     => Carbon::now(),
                'updated_at'     => Carbon::now(),
            ],
            [
                'ticket_order_id'=>3,
                'veritrans_order_id'=>'dummy1686304982039',
                'method'=>1,
                'status'=>2,
                'remark'=>null,
                'requested_at'=>Carbon::now(),
                'completed_at' => Carbon::now(),
                'created_at'     => Carbon::now(),
                'updated_at'     => Carbon::now(),
            ],
        ];

        DB::table('ticket_order_payments')->insert($ticket_order_payments);
    }
}
