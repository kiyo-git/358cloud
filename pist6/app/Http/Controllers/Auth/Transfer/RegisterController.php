<?php

namespace App\Http\Controllers\Auth\Transfer;

use App\Exceptions\RedirectExceptions;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterTransferRequest;
use App\Models\OldProfile;
use App\Models\TempUser;
use App\Models\User;
use App\Models\UserCertification;
use App\Services\RegisterService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{

    /**
     *基本情報登録
     * @param object Request $request
     * @return void
     */
    public function confirm(RegisterTransferRequest $request){
        try{
            RegisterService::findUserByemail($request->email);

            $insert_items = (object)$request->all();
            if($request->session()->has('insert_items')){//email認証後確認
                $confirmed_email = $request->session()->pull('insert_items');
                if(isset($confirmed_email->confirmed)){
                    $insert_items->confirmed =$insert_items->email;
                }
            }

            $insert_items->birth = $request->year.'-'.$request->month.'-'.$request->day;

            $old_user = OldProfile::findUserByPhone($request->phone_number);//RubyAPI代替
            $old_email = $old_user->email;
            $request->session()->put('insert_items',$insert_items);//登録用セッション

            if(($request->email !== $old_email) && !(isset($insert_items->confirmed))){ //メール認証コントローラー
                return redirect()->route('transfer.email.entry');
            }

            return view('auth.transfer.confirm',compact('insert_items'));
        }catch(\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            return redirect()->route('error',['body'=>config('auth.message.error.register.confirm')]);
        }
    }

    /**
     * メール認証ユーザー確認
     */
    public function confirmEmail($token){
        try{
            $user =  RegisterService::findEmailUser($token);
            if(isset($user['body'])){
                return redirect()->route('error',['body'=>$user['body']]);
            }
            UserCertification::setCertificatedAt('email',$user->email);
            $insert_items = TempUser::getUser($user->email);

            $insert_items->birth = $insert_items->birthday;
            $insert_items->birthday = date_create($insert_items->birthday);//生年月日を戻るボタン後表示するため
            $insert_items->year = date_format($insert_items->birthday, 'Y');
            $insert_items->month = date_format($insert_items->birthday, 'm');
            $insert_items->day = date_format($insert_items->birthday, 'd');

            $insert_items->confirmed = $insert_items->email;//メール認証後確認用
            session(['insert_items'=>$insert_items]);
            return view('auth.transfer.confirm',compact('insert_items'));
        }catch(\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            exit(config('auth.message.error.register.confirm'));
        }
    }

    /**
     * データ移行ユーザーDB登録処理
     * @param object Request $request
     * @return void
     */
    public function complete(Request $request){
        try{
            $insert_items = $request->session()->get('insert_items');
            User::Insert($insert_items);
            $user_id = User::getUserEmail($insert_items->email);
            UserCertification::setTransUserId($insert_items->email,$user_id->id,$insert_items->phone_number);
            TempUser::where('email',$insert_items->email)->delete();
            $request->session()->forget('insert_items');
            return redirect()->route('transfer.show.complete');
        }catch(\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            exit(config('auth.message.error.register.insert'));
        }
    }

    /**
     * 登録完了画面表示
     */
    public function showComplete(){
        return view('auth.transfer.complete');
    }
}
