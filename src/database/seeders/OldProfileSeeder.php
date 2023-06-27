<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OldProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('old_profiles')->insert([
            [
                'id' => 1,
                'user_id' => 1,
                'family_name' => '長尾',
                'given_name' => '知哉',
                'family_name_kana' => 'ナガオ',
                'given_name_kana' => 'トモヤ',
                'birthday' => '1992-09-13',
                'zip_code' => '1560057',
                'prefecture' => '東京都',
                'city' => '世田谷区上北沢',
                'address_line' => '4-15-4',
                'email' => 'xxx@xxx.com',
                'created_at' => '2021-09-07 15:20:25.827887',
                'updated_at' => '2022-09-13 10:20:05.025527',
                'mailmagazine' => 1,
                'phone_number' => '08081468290',
                'auth_code' => 'eyJhbGciOiJIUzI1NiIsImtpZCI6InVzZXJfYXV0aF90b2tlbiIsInR5cCI6IkpXVCJ9.eyJhdWQiOiI1NTA0MzkxMTQzMDkxMjEzNjU0IiwiZXhwIjoxOTQ2MzU1NDQ5LCJpYXQiOjE2MzA5OTU0NDksImlzcyI6Imh0dHBzOi8vcmltYS5yYXRlbC5jb20iLCJqdGkiOiIxOTg5MjMyMjY3MDg2Njc5NTY4LTU1MDQzOTExNDMwOTEyMTM2NTQtMTYzMDk5NTQ0OTU1NjU4MyIsInNjb3BlcyI6WyJ3YWxsZXQiXSwic3ViIjoiMTk4OTIzMjI2NzA4NjY3OTU2OCIsInRva2VuX2lkIjoiMTk4OTIzMjI2NzA4NjY3OTU2OC01NTA0MzkxMTQzMDkxMjEzNjU0LTE2MzA5OTU0NDk1NTY1ODMiLCJ0b2tlbl9zZWNyZXQiOiItTnBaUFBTNUlTSjFwZmE4WENIRUo2OHE4UnVScF9JUUJfWDZvcndCYW9VIn0.ICV7AkBI5EXQjXA5pBT21RNFmgElc4HDjOU1-58AHvU',
                'ng_user_check' => 1,
                'address_detail' => 'LAPiS上北沢Ⅰ 104',
            ],
            [
                'id' => 2,
                'user_id' => 2,
                'family_name' => '小田島',
                'given_name' => '茉里',
                'family_name_kana' => 'オダシマ',
                'given_name_kana' => 'マリ',
                'birthday' => '1993-03-24',
                'zip_code' => '1510065',
                'prefecture' => '神奈川県',
                'city' => '渋谷区大山町',
                'address_line' => '１ー25',
                'email' => 'xxx@xxx.com',
                'created_at' => '2021-09-07 17:52:59.608906',
                'updated_at' => '2022-09-13 10:20:05.047140',
                'mailmagazine' => 1,
                'phone_number' => '09075675203',
                'auth_code' => 'eyJhbGciOiJIUzI1NiIsImtpZCI6InVzZXJfYXV0aF90b2tlbiIsInR5cCI6IkpXVCJ9.eyJhdWQiOiI1NTA0MzkxMTQzMDkxMjEzNjU0IiwiZXhwIjoxOTQ2MzY0NzQyLCJpYXQiOjE2MzEwMDQ3NDIsImlzcyI6Imh0dHBzOi8vcmltYS5yYXRlbC5jb20iLCJqdGkiOiI4NzIyNzg1NDg1NTUwNTEwMDI1LTU1MDQzOTExNDMwOTEyMTM2NTQtMTYzMTAwNDc0MjIzODU4NyIsInNjb3BlcyI6WyJ3YWxsZXQiXSwic3ViIjoiODcyMjc4NTQ4NTU1MDUxMDAyNSIsInRva2VuX2lkIjoiODcyMjc4NTQ4NTU1MDUxMDAyNS01NTA0MzkxMTQzMDkxMjEzNjU0LTE2MzEwMDQ3NDIyMzg1ODciLCJ0b2tlbl9zZWNyZXQiOiIwRUlzS3hOOWlSR0w5WVhjVFc4NW9KZllfYWF4ZmpfVDUwMm5fMW4wWVBJIn0.gZlsVPMStG3hcmOWRSuCzz7-C3T3wU7Tm-FyfDn3bbU',
                'ng_user_check' => 1,
                'address_detail' => ''
            ],
            [
                'id' => 3,
                'user_id' => 3,
                'family_name' => '入星',
                'given_name' => '祥吾',
                'family_name_kana' => 'イリボシ',
                'given_name_kana' => 'ショウゴ',
                'birthday' => '1984-11-19',
                'zip_code' => '1750092',
                'prefecture' => '東京都',
                'city' => '板橋区',
                'address_line' => '赤塚三丁目4－5アネストハイム103号室',
                'email' => 'xxx@xxx.com',
                'created_at' => '2021-09-08 09:47:18.925606',
                'updated_at' => '2022-09-13 10:20:05.069176',
                'mailmagazine' => 1,
                'phone_number' => '08023456789',
                'auth_code' => 'eyJhbGciOiJIUzI1NiIsImtpZCI6InVzZXJfYXV0aF90b2tlbiIsInR5cCI6IkpXVCJ9.eyJhdWQiOiI1NTA0MzkxMTQzMDkxMjEzNjU0IiwiZXhwIjoxOTQ2MzY1MzA3LCJpYXQiOjE2MzEwMDc1MDcsImlzcyI6Imh0dHBzOi8vcmltYS5yYXRlbC5jb20iLCJqdGkiOiIxNTQ4MTI1MzY2ODQ0NzY1ODI2LTU1MDQzOTExNDMwOTEyMTM2NTQtMTYzMTAwNzUwNzE4MjYzNiIsInNjb3BlcyI6WyJ3YWxsZXQiXSwic3ViIjoiMTU0ODEyNTM2Njg0NDc2NTgyNiIsInRva2VuX2lkIjoiMTU0ODEyNTM2Njg0NDc2NTgyNi01NTA0MzkxMTQzMDkxMjEzNjU0LTE2MzEwMDc1MDcxODI2MzYiLCJ0b2tlbl9zZWNyZXQiOiI3Z3UtMzI5Tm9oVEs2NnJxaTNQRFBndXp2ckRzcX9KVWpZcTdxbHlsSThKIn0.LPdDy2WSPibG4i8o31PAtMMpxxyRJ9ZL1cHwVRPC8Fw',
                'ng_user_check' => 1,
                'address_detail' => ''
            ],
            [
                'id' => 4,
                'user_id' => 4,
                'family_name' => 'ゆうき',
                'given_name' => 'あゆ',
                'family_name_kana' => 'ユウキ',
                'given_name_kana' => 'アユ',
                'birthday' => '1987-08-01',
                'zip_code' => '1230054',
                'prefecture' => '千葉県',
                'city' => '市原市',
                'address_line' => '1−2−3',
                'email' => 'xxx@xxx.com',
                'created_at' => '2021-09-07 19:08:36.356628',
                'updated_at' => '2022-09-13 10:20:05.078842',
                'mailmagazine' => 1,
                'phone_number' => '08049575242',
                'auth_code' => 'eyJhbGciOiJIUzI1NiIsImtpZCI6InVzZXJfYXV0aF90b2tlbiIsInR5cCI6IkpXVCJ9.eyJhdWQiOiI1NTA0MzkxMTQzMDkxMjEzNjU0IiwiZXhwIjoxOTQ2MzY5MjAwLCJpYXQiOjE2MzEwMDkyMDAsImlzcyI6Imh0dHBzOi8vcmltYS5yYXRlbC5jb20iLCJqdGkiOiI4NjI0NzkzMzI4MjYxMjQ0NjI3LTU1MDQzOTExNDMwOTEyMTM2NTQtMTYzMTAwOTIwMDI4MDc2NSIsInNjb3BlcyI6W10sInN1YiI6Ijg2MjQ3OTMzMjgyNjEyNDQ2MjciLCJ0b2tlbl9pZCI6Ijg2MjQ3OTMzMjgyNjEyNDQ2MjctNTUwNDM5MTE0MzA5MTIxMzY1NC0xNjMxMDA5MjAwMjgwNzY1IiwidG9rZW5fc2VjcmV0IjoiVEZiQ0o4dVU1b240Qll3aXA2RmtnX1FZZGg4cVJrWjE2a2JZX2Z5MlRBNCJ9.WNXCqaTYDxb-WSOk8rs-DRd6EwQaZdS58RQnqpbKDzA',
                'ng_user_check' => 1,
                'address_detail' => null,
            ],
        ]);
    }
}
