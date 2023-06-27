<?php

namespace App\Http\Controllers\Auth\NewUser;

use App\Http\Controllers\Controller;
use App\Models\OldProfile;
use App\Models\OldUser;
use App\Models\TempUser;
use App\Models\User;
use App\Models\UserCertification;
use App\Services\VerifySMSService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use SendGrid;
use SendGrid\Mail\Mail;

class VerifyEmailController extends Controller
{
    protected $OldProfile;
    protected $UserCertification;

    public function __construct(OldProfile $OldProfile, UserCertification $UserCertification)
    {
        $this->OldProfile        = $OldProfile;
        $this->UserCertification = $UserCertification;
    }

    /**
     * 初期表示(メールアドレス入力画面)
     *
     * @return void
     */
    public function show()
    {
        return view('auth.newUser.verifyEmail');
    }

     /**
     * メールを送信する関数
     * @param object Request $request
     * @return void
     */
    public function sent(Request $request)
    {
        $request->validate([
            'email' => 'required|email:filter,dns',
            'term' => 'required',
        ]);

        try{
            $token = hash('sha256', uniqid(rand(), 1));
            $email = $request->email;

            //登録済みユーザー確認
            $user = User::getUserEmail($email);
            if($user){
                $msg = config('auth.message.error.user_email.registered');
                return redirect()->back()->withErrors($msg)->withInput();
            }

            $old_user = OldProfile::findUserByEmail($email);
            if($old_user){
                $msg = config('auth.message.error.user_email.registered_old');
                return redirect()->back()->withErrors($msg)->withInput();
            }

            $user = UserCertification::InsertEmail($email,$token);

            self::sentMail($email,$token);

            Log::debug(url("/user/register/token=".$token));

        }catch(\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            exit(config('auth.message.error.register.confirm'));//変更
        }

        return view('auth.newUser.registerEmail');
    }

    public function verify($token){
        try{

        $user = UserCertification::findUserByToken($token);
        if(empty($user)){//メール認証失敗時
            $msg = config('auth.message.error.user_email.confirm');
            Log::Error($msg,['token',$token]);
            exit($msg);
        }
        if(!($user->created_at->between(Carbon::now()->subHour(24), Carbon::now()))){
            $msg = config('auth.message.error.user_email.expired_token');
            Log::warning($msg,['token',$token]);
            return redirect()->route('user.email.input')->withErrors($msg);
        }

        $email = $user->email;

        //登録済みユーザー確認
        $user = User::getUserEmail($email);
        if($user){
            $msg = config('auth.message.error.user_email.registered');
            return redirect()->back()->withErrors($msg);
        }

        UserCertification::setCertificatedAt('email',$email);
        return view('auth.newUser.register',compact('email'));

        }catch(\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            exit(config('auth.message.error.register.confirm'));//変更
        }
    }
    /**
     * メール送信
     */
    private static function sentMail($to,$token){

        $token_url = config('app.url') . '/user/register/token=' . $token;
        $contact = config('portfolio.mail.contact_URL');

        $email = new Mail();
        $email->setFrom(config('mail.sendgrid.from'),config('app.name'));
        $email->setSubject('【portfolio 認証メール】');
        $email->addTo($to);
        $email->addContent(
            "text/plain",
            strval(
                view(
                    'auth.newUser.mail',
                    compact('token_url','contact')
                )
            )
        );

        $sendgrid = new SendGrid(config('mail.sendgrid.api_key'));

        $sendgrid->send($email);
    }
}
