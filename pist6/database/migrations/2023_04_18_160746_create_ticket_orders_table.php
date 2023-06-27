<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_orders', function (Blueprint $table) {
            $table->comment('チケット注文マスター');
            
            $table->bigIncrements('id');
            $table->foreignId('user_id')->comment('ユーザーID（users.id）');
            $table->integer('subtotal_amount')->comment('小計（割引適用前） [円]');
            $table->integer('campaign_discount')->default(0)->comment('キャンペーン割引価格 [円]');
            $table->integer('coupon_discount')->default(0)->comment('クーポン割引価格 [円]');
            $table->integer('option_discount')->default(0)->comment('オプション割引価格 [円]');
            $table->integer('total_amount')->comment('合計（割引適用後） [円]');
            $table->tinyInteger('is_replaced')->default(1)->comment('基盤移行フラグ。
「250-portal」及び「mixi-m」からの移行に伴い、座席情報テーブルやクーポン情報テーブル等の基盤が移行されていたか判定するために設定。
（0：移行前, 1：移行後）');
            $table->foreignId('user_coupon_id')->nullable()->comment('userが所持しているクーポンID（user_coupons.id）');
            $table->foreignId('seat_sale_id')->nullable()->comment('販売スケジュールID（seat_sales.id）');
            $table->timestamp('canceled_at')->nullable()->comment('キャンセル日時');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ticket_orders');
    }
};
