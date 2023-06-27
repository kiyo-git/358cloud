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
        Schema::create('user_certifications', function (Blueprint $table) {
            $table->comment('一般ユーザー認証情報');

            $table->id()->comment('id');
            $table->unsignedBigInteger('user_id')->nullable()->comment('ユーザーID');
            $table->tinyInteger('type')->comment('認証タイプ');
            $table->string('phone_number',255)->nullable()->comment('電話番号');
            $table->unsignedBigInteger('old_user_id')->nullable()->comment('旧会員ユーザーID');
            $table->string('email',255)->nullable()->comment('メールアドレス');
            $table->string('email_token',255)->nullable()->comment('メールアドレス認証');
            $table->timestamp('transfered_at')->nullable()->comment('移行完了日時');
            $table->timestamp('certificated_at')->nullable()->comment('認証完了日時');
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
        Schema::dropIfExists('user_certifications');
    }
};
