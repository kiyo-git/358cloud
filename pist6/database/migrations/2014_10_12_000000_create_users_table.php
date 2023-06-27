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
        Schema::create('users', function (Blueprint $table) {
            $table->comment('一般ユーザーマスター');

            $table->id()->autoIncrement()->from(200000)->comment('id');
            $table->string('email')->unique()->comment('メールアドレス');
            $table->string('password')->comment('パスワード');
            $table->rememberToken()->comment('RememberMeトークン');
            $table->string('family_name')->comment('姓');
            $table->string('given_name')->comment('名');
            $table->string('family_name_kana')->comment('セイ');
            $table->string('given_name_kana')->comment('メイ');
            $table->string('birthday')->comment('生年月日');
            $table->string('phone_number')->comment('電話番号');
            $table->string('zip_code')->comment('郵便番号');
            $table->string('prefecture')->comment('住所（都道府県）');
            $table->string('city')->comment('住所（市区町村）');
            $table->string('block')->comment('住所（番地）');
            $table->string('building')->nullable()->comment('住所（建物名）');
            $table->tinyInteger('mailmagazine_flg')->default(0)->comment('メルマガ登録フラグ');
            $table->tinyInteger('ng_user_check')->default(0)->comment('NGユーザーチェック');
            $table->string('qr_user_id')->nullable()->comment('QRコードID');
            $table->softDeletes();
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
        Schema::dropIfExists('users');
    }
};
