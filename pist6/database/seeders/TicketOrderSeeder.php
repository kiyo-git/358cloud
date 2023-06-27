<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TicketOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ticket_orders = [
            [
                'user_id'    => '200001',
                'subtotal_amount' => 100,
                'campaign_discount'     => 0,
                'coupon_discount'     => 0,
                'option_discount'     => 0,
                'total_amount'     => 100,
                'is_replaced'     => 0,
                'created_at'     => Carbon::now(),
                'updated_at'     => Carbon::now(),
            ],
            [
                'user_id'    => '200001',
                'subtotal_amount' => 100,
                'campaign_discount'     => 0,
                'coupon_discount'     => 0,
                'option_discount'     => 0,
                'total_amount'     => 100,
                'is_replaced'     => 0,
                'created_at'     => Carbon::now(),
                'updated_at'     => Carbon::now(),
            ],
            [
                'user_id'    => '200001',
                'subtotal_amount' => 100,
                'campaign_discount'     => 0,
                'coupon_discount'     => 0,
                'option_discount'     => 0,
                'total_amount'     => 100,
                'is_replaced'     => 0,
                'created_at'     => Carbon::now(),
                'updated_at'     => Carbon::now(),
            ],
        ];

        DB::table('ticket_orders')->insert($ticket_orders);
    }
}
