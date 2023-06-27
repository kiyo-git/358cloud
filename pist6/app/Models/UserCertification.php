<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class UserCertification extends Model
{

    protected $table = 'user_certifications';

    protected $guarded = [
        'id',
    ];

    const TYPE_TRANSFER = 1;
    const TYPE_NEW      = 2;

    const TYPE = [
        self::TYPE_TRANSFER => 'データ移行ユーザー',
        self::TYPE_NEW      => '新規登録ユーザー',
    ];

    /**
     * データ移行ユーザー
     * SMS認証完了時のレコード作成用関数
     * @param string $old_user_id
     * @param string $phone_number
     * @return void
     */
    public static function createSmsTransfer($old_user_id, $phone_number)
    {
        $params = [
            'type'             => self::TYPE_TRANSFER,
            'old_user_id'      => $old_user_id,
            'phone_number'     => $phone_number,

        ];

        UserCertification::updateOrCreate(['old_user_id' => $old_user_id],$params);
    }

    public static function InsertEmailTransfer($id,$email,$token){
        return UserCertification::where('id',$id)
            ->update([
                'email'       => $email,
                'email_token' => $token,
            ]);
    }

    public static function InsertEmail($email,$token){
        return UserCertification::create([
                'type'        => self::TYPE_NEW,
                'email'       => $email,
                'email_token' => $token,
            ]);
    }

    public static function setCertificatedAt($key,$email){
        return UserCertification::where($key,$email)
        ->update([
            'certificated_at' => Carbon::now(),
        ]);
    }

    public static function findId($phone_number){
        return UserCertification::where('phone_number',$phone_number)
        ->select('id')
        ->first();
    }

    public static function findUserByToken($token){
        return UserCertification::where('email_token',$token)
        ->first();
    }

    public static function setUserId($email,$user_id){
        return UserCertification::where('email',$email)
        ->update([
            'user_id'=>$user_id,
        ]);
    }

    public static function setTransUserId($email,$user_id,$phone_number){
        return UserCertification::where('email',$email)
        ->orwhere('phone_number',$phone_number)
        ->update([
            'user_id'=>$user_id,
            'transfered_at'=>Carbon::now(),
        ]);
    }

    public static function findUserByPhone($phone_number){
        return UserCertification::where('phone_number',$phone_number)
        ->whereNotNull('transfered_at')
        ->first();
    }

    public static function findUserByUserId($id){
        return UserCertification::where('user_id',$id)
        ->whereNotNull('transfered_at')
        ->select('old_user_id')
        ->first();
    }

}
