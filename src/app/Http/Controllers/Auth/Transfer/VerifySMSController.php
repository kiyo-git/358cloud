<?php

namespace App\Http\Controllers\Auth\Transfer;

use App\Http\Controllers\Controller;
use App\Models\OldProfile;
use App\Models\TempUser;
use App\Models\User;
use App\Models\UserCertification;
use App\Services\VerifySMSService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class VerifySMSController extends Controller
{
    protected $OldProfile;
    protected $UserCertification;

    public function __construct(OldProfile $OldProfile, UserCertification $UserCertification)
    {
        $this->OldProfile        = $OldProfile;
        $this->UserCertification = $UserCertification;
    }

    /**
     * 初期表示(電話番号入力画面)
     *
     * @return void
     */
    public function show()
    {
        return view('auth.transfer.registerSMS');
    }

    /**
     * 初期表示(電話番号入力画面)
     *
     * @return void
     */
    public function showFromNews()
    {
        return view('auth.transfer.registerSMSFromNews');
    }

     /**
     * SMS認証コードを送信する関数
     * @param object Request $request
     * @return void
     */
    public function verify(Request $request)
    {
        $request->validate([
            'phone_number' => 'required|max:255|regex:/^[0-9]+$/',
            'term' => 'required',
        ]);

        $phone_number = $request->phone_number;

        // 旧会員ユーザー情報の有無を判定
        try {
            $is_user = UserCertification::findUserByphone($phone_number);
            if($is_user){//移行済
                return redirect()->back()->withErrors(config('auth.message.error.sms_entry.registered'));
            }

            [$old_user_is_exist, $old_user_id] = VerifySMSService::oldUserIsExist($phone_number);
            if ( !$old_user_is_exist ) {// 移行対象外ユーザー
                return redirect()->back()->withErrors(config('auth.message.error.sms_entry.no_register'));
            }

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            exit(config('auth.message.error.transfer_user_search.search'));
        }


        // 入力された電話番号へ認証コードを送信
        try {
            VerifySMSService::createSmsCertCode($phone_number);
            Log::info(config('auth.message.success.sms.create'),['旧会員ユーザーID: ' . $old_user_id]);
            // Log::debug('電話番号: ' . $phone_number . ', 旧会員ユーザーID: ' . $old_user_id);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            exit(config('auth.message.error.sms_entry.create_sms'));
        }

        UserCertification::createSmsTransfer($old_user_id, $phone_number);// 「user_certification」へ新規挿入(update)

        return view('auth.transfer.verifySMS', compact('phone_number', 'old_user_id'));//認証画面へ
    }

    /***
     * バリデーションエラー用
     */
    public function showVerifySMS(Request $request){
        $phone_number = $request->phone_number;
        $old_user_id = $request->old_user_id;
        if(empty($phone_number)){
            return redirect()->route('error',['body'=>config('portfolio.error.access')]);
        }
        return view('auth.transfer.verifySMS', compact('phone_number', 'old_user_id'));//認証画面へ
    }
    /**
     * 入力されたSMS認証コードを検証する関数
     * @param object Request $request
     * @return void
     */
    public function verifyCheck(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pin_code' => 'required|digits:6',
        ]);

        $phone_number = $request->phone_number;
        $old_user_id = $request->old_user_id;
        if ($validator->fails()) {
            return redirect()->route('transfer.sms.cert',compact('phone_number','old_user_id'))->withErrors($validator);
        }
        $attr = $request->only(['phone_number', 'old_user_id', 'pin_code']);

        try {
            [$old_user_is_exist, $origin_user_id] = VerifySMSService::oldUserIsExist($attr['phone_number']);

            if ( $origin_user_id !== $attr['old_user_id'] && !$old_user_is_exist ) {// 渡された「phone_number」と「old_user_id」が同一レコードのものか再度検証
                exit(config('auth.message.error.sms_verify.not_allowed'));
            }

            $result = VerifySMSService::verifySmsCertCode($attr['phone_number'], $attr['pin_code']);// 認証コードの検証
        } catch (\Exception $e) {// 認証失敗
            Log::error($e->getMessage());
            return redirect()->route('transfer.sms.cert',compact('phone_number','old_user_id'))->withErrors(config('auth.message.error.sms_verify.wrong_code'));
        }

        // 認証失敗
        if ( $result !== 'approved' ) {
            $phone_number = $attr['phone_number'];
            Log::error(config('auth.message.error.sms_verify.wrong_code'),['old_user_id'=>$attr['old_user_id']]);
            return redirect()->route('transfer.sms.cert',compact('phone_number','old_user_id'))->withErrors(config('auth.message.error.sms_verify.wrong_code'));
        }

        //認証成功
        DB::beginTransaction();
        try {
             // 「old_user」の情報取得と整形
            $old_user = VerifySMSService::arrangeOldUser($attr['phone_number']);
            UserCertification::setCertificatedAt('phone_number',$attr['phone_number']);
            // VerifySMSService::findUserByemail($old_user->email);//userが新規登録していないか確認
            DB::commit();

            return view('auth.transfer.register', compact('old_user'));

        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            exit(config('auth.message.error.sms_verify.certification'));
        }
    }

    /**
     * バリデーションエラー戻り用
     */
    public function registerView(Request $request){
        $old_user = $request->session()->get('insert_items');
        if(empty($old_user)){
            return redirect()->route('error',['body'=>config('portfolio.error.access')]);
        }
        return view('auth.transfer.register',compact('old_user'));
    }
}
