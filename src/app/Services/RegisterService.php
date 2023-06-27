<?php
namespace App\Services;

use App\Models\User;
use App\Models\UserCertification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;


class RegisterService
{
    /**
     * email認証ユーザー検索
     */
    public static function findEmailUser ($token){
        try{
            $user = UserCertification::findUserByToken($token);
            if(empty($user)){//メール認証失敗時
                $body = config('auth.message.error.register.confirm');
                Log::error($body,['token',$token]);
                return compact('body');
            }
            if(!empty($user->transfered_at)){
                $body = config('auth.message.error.user_email.registered');
                return compact('body');
            }
        return $user;
        }catch(\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            exit(config('auth.message.error.register.confirm'));
        }

    }
     /**
     * データ移行ユーザーが新規登録ユーザーにいないかをチェック
     */
    public static function findUserByemail($email){
        $new_user =User::getUserEmail($email);
        if($new_user){
            return redirect()->route('login')->withErrors(config('auth.message.error.sms_verify.registered'));
        }
        return;
    }
}
