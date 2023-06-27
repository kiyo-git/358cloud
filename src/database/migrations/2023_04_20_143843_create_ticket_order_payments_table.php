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
        Schema::create('ticket_order_payments', function (Blueprint $table) {
            $table->comment('チケット決済情報');

            $table->bigIncrements('id');
            $table->foreignId('ticket_order_id')->comment('チケット注文ID（ticket_orders.id）');
            $table->string('veritrans_order_id', 64)->comment('veritransオーダーID（各決済毎にveritransに連携するユニークな値）');
            $table->tinyInteger('method')->comment('支払い方法（1：クレジット（3D認証）, 2：PayPay, 3：ネットバンク)');
            $table->tinyInteger('status')->default(1)->comment('ステータス（1：購入可能, 2：購入完了, 3：購入時間超過, 4：購入エラー, 5：連携エラー, 6：購入キャンセル）');
            $table->string('remark')->nullable()->comment('補足事項');
            $table->timestamp('requested_at')->comment('決済リクエスト日時');
            $table->timestamp('completed_at')->nullable()->comment('決済完了日時');
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
        Schema::dropIfExists('ticket_order_payments');
    }
};
