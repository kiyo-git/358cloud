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
        Schema::create('change_logs', function (Blueprint $table) {
            $table->comment('管理者変更履歴');

            $table->id()->comment('id');
            $table->unsignedBigInteger('admin_user_id')->comment('更新管理ユーザーID');
            $table->string('table')->comment('更新対象テーブル');
            $table->string('target_id')->comment('更新対象id');
            $table->json('columns')->comment('更新対象カラム');
            $table->smallInteger('type')->comment('更新タイプ（1：新規登録, 2：更新, 3：削除）');
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
        Schema::dropIfExists('change_logs');
    }
};
