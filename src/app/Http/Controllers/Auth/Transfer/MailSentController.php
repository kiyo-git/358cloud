<?php

namespace App\Http\Controllers\Auth\Transfer;

use App\Http\Controllers\Controller;
use App\Mail\TransferMail;
use App\Models\TempUser;
use App\Models\User;
use App\Models\UserCertification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
// use Illuminate\Support\Facades\Mail;
use SendGrid;
use SendGrid\Mail\Mail;

class MailSentController extends Controller
{

    public function entryEmail(Request $request){
        try{

            $insert_items = $request->session()->get('insert_items');

            if(empty($insert_items->email)){
                return redirect()->route('error',['body'=>config('portfolio.error.access')]);
            }

            $token = hash('sha256', uniqid(rand(), 1));
            $email = $insert_items->email;
            $user = User::getUserEmail($email);
            if($user){//登録済か検索
                $msg = config('auth.message.error.user_email.same_email');
                return redirect()->back()->withInput()->withErrors($msg);
            }

            $id = UserCertification::findId($insert_items->phone_number);//電話番号が一意ではないため
            UserCertification::InsertEmailTransfer($id->id,$email,$token);

            $user_certification_id = UserCertification::findId($insert_items->phone_number);
            $insert_items->user_certification_id = $user_certification_id->id;
            TempUser::Insert($insert_items);
            self::sent($email,$token);

            Log::debug(url("transfer/confirm/token=".$token));
            return view('auth.transfer.mailcertification');
        }catch(\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            exit(config('auth.message.error.register.confirm'));
        }
    }

    /**
     * メール送信
     */
    private static function sent($to,$token){

        // Mail::send(new TransferMail($to,$token));//mailクライアント決定までコメントアウト
        $email = new Mail();
        $email->setFrom(config('mail.sendgrid.from'),config('app.name'));
        $email->setSubject('【portfolio 認証メール】');
        $email->addTo($to);
        $email->addContent(
            "text/plain",
            strval(
                view(
                    'auth.transfer.mail',
                    compact('token')
                )
            )
        );

        $sendgrid = new SendGrid(config('mail.sendgrid.api_key'));

        $sendgrid->send($email);
    }
}
