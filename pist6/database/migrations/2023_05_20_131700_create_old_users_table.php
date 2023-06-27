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
        Schema::create('old_users', function (Blueprint $table) {
            $table->comment('旧会員ユーザー');

            $table->id()->comment('id');
            $table->unsignedBigInteger('sixgram_id')->nullable()->comment('ユーザーID');
            $table->string('email_auth_code',255)->nullable()->comment('メール認証コード');
            $table->timestamp('email_auth_expired_at')->nullable()->comment('メール認証期限');
            $table->tinyInteger('email_verified')->nullable()->comment('メール認証');
            $table->string('qr_user_id',255)->nullable()->comment('QRコードID');
            $table->timestamp('unsubscribe_mail_sent_at')->nullable();
            $table->string('unsubscribe_uuid',255)->nullable();
            $table->timestamps();
            $table->softDeletes()->comment('退会日時');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('old_users');
    }
};
