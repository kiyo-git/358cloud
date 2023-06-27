<?php
namespace App\Services;

use App\Models\OldProfile;
use App\Models\User;
use Twilio\Rest\Client;

class VerifySMSService
{
    /**
     * 旧会員ユーザーに入力された電話番号が存在するか判定する関数
     *
     * @param string $phone_number
     * @return boolean $is_exist
     * @return string $old_user_id
     */
    public static function oldUserIsExist($phone_number)
    {
        $old_user = OldProfile::findUserByPhone($phone_number);

        $is_exist    = (bool) $old_user;
        $old_user_id = $is_exist ? $old_user->user_id : null;

        return [$is_exist, $old_user_id];
    }

    /**
     * 旧会員ユーザー情報を取得し、基本情報入力画面へ渡すために整形する関数
     *
     * @param string $phone_number
     * @return object $old_user
     */
    public static function arrangeOldUser($phone_number)
    {
        $old_user = OldProfile::findUserByPhone($phone_number);

        // 生年月日の解体
        [$year, $month, $day] = explode('-', $old_user->birthday);

        $old_user->year  = $year;
        $old_user->month = $month;
        $old_user->day   = $day;

        return $old_user;
    }

    /**
     * TwilioのClientに値を設定し、インスタンス化する関数
     * @param void
     * @return object Client $client
     */
    public static function instantiateTwilioClient()
    {
        $id   = config('auth.common.twilio.account_sid');
        $token = config('auth.common.twilio.auth_token');

        return $client = new Client($id, $token);
    }

    /**
     * 電話番号を国際番号化する関数
     *
     * @param string $phone_number
     * @return string $natinal_phone_number
     */
    public static function nationalizePhoneNumber($phone_number)
    {
        // 電話番号の頭に、国際コードを追加（日本の電話番号のみを想定）
        return config('auth.common.twilio.national_code') . $phone_number;
    }

    /**
     * SMSの認証コードを入力された電話番号宛に送信する関数
     *
     * @param object Client $client
     * @param string $phone_number
     * @return void
     */
    public static function createSmsCertCode($phone_number)
    {
        $natinal_phone_number = self::nationalizePhoneNumber($phone_number);

        $client = self::instantiateTwilioClient();

        $client->verify->v2->services(config('auth.common.twilio.verification_sid'))
                ->verifications
                ->create($natinal_phone_number, 'sms');
        return;
    }

    /**
     * 入力された認証コードをTwilioへ送り、検証する関数
     * @param object Client $client
     * @param string $phone_number
     * @param string $pin_code
     * @return string $status
     */
    public static function verifySmsCertCode($phone_number, $pin_code)
    {
        $natinal_phone_number = self::nationalizePhoneNumber($phone_number);

        // $client = self::instantiateTwilioClient();
        $id   = config('auth.common.twilio.account_sid');
        $token = config('auth.common.twilio.auth_token');

        $client = new Client($id, $token);

        $result = $client->verify->v2->services(config('auth.common.twilio.verification_sid'))
                        ->verificationChecks
                        ->create([
                            'to'   => $natinal_phone_number,
                            'code' => $pin_code,
                        ]);

        return $result->status;
    }

    /**
     * データ移行ユーザーが新規登録ユーザーにいないかをチェック
     */
    public static function findUserByemail($email){
        $new_user =User::getUserEmail($email);
        if($new_user){
            return redirect()->back()->withErrors(config('auth.message.error.sms_verify.registered'));
        }
        return;
    }
//   public function makeUrlToken ()
//   {
//     $url_token = hash('sha256', uniqid(rand(), 1));
//     return $url_token;
//   }
}
