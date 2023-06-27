<?php

namespace App\Libs\Admin;

use App\Models\User;

class Download {
    /**
     * ダウンロード実行
     *
     * @return void
     */
    public function download($param)
    {
        $callback = function () use ($param) {
            $stream = fopen('php://output', 'w');

            stream_filter_prepend($stream, 'convert.iconv.utf-8/cp932//TRANSLIT');

            fputcsv($stream, $this->getUsersHeader());

            $User = new User();
            $users = $User->getUserListBySearch($param)->orderBy('id')->withTrashed()->get();
            foreach ($users as $user) {
                fputcsv($stream, $this->setUsersData($user));
            }
            fclose($stream);
        };

        $filename = 'users.csv';

        $header = [
            'Content-Type' => 'application/octet-stream',
        ];

        return response()->streamDownload($callback, $filename, $header);
    }

    /**
     * ユーザーCSVヘッダー
     *
     * @return array
     */
    private function getUsersHeader()
    {
        return [
            'id'
            , 'email'
            , 'family_name'
            , 'given_name'
            , 'family_name_kana'
            , 'given_name_kana'
            , 'birthday'
            , 'phone_number'
            , 'zip_code'
            , 'prefecture'
            , 'city'
            , 'block'
            , 'building'
            , 'mailmagazine_flg'
            , 'deleted_at'
            , 'created_at'
            , 'updated_at'
        ];
    }

    /**
     * ユーザーCSV値
     *
     * @param object $user
     * @return array
     */
    private function setUsersData($user)
    {
        return [
            $user->id
            , $user->email
            , $user->family_name
            , $user->given_name
            , $user->family_name_kana
            , $user->given_name_kana
            , $user->birthday
            , $user->phone_number
            , $user->zip_code
            , $user->prefecture
            , $user->city
            , $user->block
            , $user->building
            , $user->mailmagazine_flg
            , $user->deleted_at
            , $user->created_at
            , $user->updated_at
        ];
    }
}
