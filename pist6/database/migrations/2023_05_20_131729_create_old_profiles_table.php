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
        Schema::create('old_profiles', function (Blueprint $table) {
            $table->comment('旧会員ユーザー基本情報');

            $table->id()->comment('id');
            $table->unsignedBigInteger('user_id')->nullable()->comment('ユーザーID');
            $table->string('family_name')->comment('姓');
            $table->string('given_name')->comment('名');
            $table->string('family_name_kana')->comment('姓カナ');
            $table->string('given_name_kana')->comment('名カナ');
            $table->string('birthday',10)->comment('誕生日');
            $table->string('zip_code',7)->comment('郵便番号');
            $table->string('prefecture')->comment('都道府県');
            $table->string('city')->comment('市町村');
            $table->string('address_line')->comment('住所');
            $table->string('building')->nullable()->comment('住所（建物名）');
            $table->string('email')->comment('メール');
            $table->tinyInteger('mailmagazine')->comment('メールマガジン');
            $table->string('phone_number',15)->comment('電話番号');
            $table->text('auth_code')->comment('認証コード');
            $table->tinyInteger('ng_user_check')->default(0)->comment('NGユーザーチェック');
            $table->string('address_detail')->nullable()->comment('住所詳細');
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
        Schema::dropIfExists('old_profiles');
    }
};
