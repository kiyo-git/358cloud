<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OldUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('old_users')->insert([
            [
                'id' => 1,
                'sixgram_id' => '1989232267086679568',
                'qr_user_id' => 'de20a800314b4fccba4ca963973c4416',
                'email_verified' => 1,
                'email_auth_code' => 'k9Jo01wKK8x4B8Lk',
                'email_auth_expired_at' => '2021-09-09 14:52:51',
                'created_at' => '2021-09-07 15:20:25.823423',
                'updated_at' => '2021-10-12 11:40:00.907412',
                'deleted_at' => null,
                'unsubscribe_uuid' => null,
                'unsubscribe_mail_sent_at' => null,
            ],
            [
                'id' => 2,
                'sixgram_id' => '8722785485550510025',
                'qr_user_id' => null,
                'email_verified' => 1,
                'email_auth_code' => '7jw7bvEsyRUGO_i_',
                'email_auth_expired_at' => '2021-09-08 18:43:22',
                'created_at' => '2021-09-07 17:52:59.605122',
                'updated_at' => '2021-09-07 18:43:57.046939',
                'deleted_at' => null,
                'unsubscribe_uuid' => null,
                'unsubscribe_mail_sent_at' => null,
            ],
            [
                'id' => 3,
                'sixgram_id' => '6878979047207555162',
                'qr_user_id' => null,
                'email_verified' => 1,
                'email_auth_code' => 'CQMsDV977bkGcsE3',
                'email_auth_expired_at' => '2021-09-08 18:44:24',
                'created_at' => '2021-09-07 18:43:40.634520',
                'updated_at' => '2021-09-07 19:20:58.965122',
                'deleted_at' => null,
                'unsubscribe_uuid' => null,
                'unsubscribe_mail_sent_at' => null,
            ],
            [
                'id' => 4,
                'sixgram_id' => '8624793328261244627',
                'qr_user_id' => null,
                'email_verified' => 1,
                'email_auth_code' => 'aj2CwTo4NcvG5bEP',
                'email_auth_expired_at' => '2021-09-08 19:10:36',
                'created_at' => '2021-09-07 19:08:36.353283',
                'updated_at' => '2021-09-07 19:11:10.976918',
                'deleted_at' => null,
                'unsubscribe_uuid' => null,
                'unsubscribe_mail_sent_at' => null,
            ],
        ]);
    }
}
