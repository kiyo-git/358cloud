<?php

namespace App\Http\Controllers\Auth\NewUser;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
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
     * バリデーションエラー戻り用
     */
    public function registerView(){

        if(!(session()->hasOldInput())){
            return redirect()->route('error',['body'=>config('portfolio.error.access')]);
        }
        return view('auth.newUser.register');
    }

    /**
     *基本情報登録
     * @param object Request $request
     * @return void
     */
    public function confirm(RegisterRequest $request){
        try{
            // RegisterService::confirmZipCode($request->zip_code);
            //登録済みユーザー確認
            $user = User::getUserEmail($request->email);//サービス
            if($user){
                $msg = config('auth.message.error.user_email.registered');
                return redirect()->route('login')->withErrors($msg);
            }

            $insert_items = (object)$request->all();
            $insert_items->birth = $request->year.'-'.$request->month.'-'.$request->day;

            $request->session()->put('insert_items',$insert_items);//登録用セッション

            if($request->email !== $request->confirm_email){
                exit(config('auth.message.error.user.not_allowed'));
            }

            return view('auth.newUser.confirm',compact('insert_items'));
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
            UserCertification::setUserId($insert_items->email,$user_id->id);
            $request->session()->forget('insert_items');
            return redirect()->route('user.show.complete');
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
        return view('auth.newUser.complete');
    }
}
