<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\OldProfile;
use App\Models\TempUser;
use App\Models\User;
use App\Models\UserCertification;
use App\Services\RegisterService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{

  /** 
   * @return View
   */
  public function login()
  {
    if ( Auth::check() ) {
      return redirect()->route('payment.index');//ルーティング変更
    }
    
    return view('auth.login');
  }

  /**
   * @param App\Http\Requests\LoginRequest
   * $request
   */
  public function confirm(LoginRequest $request)
  {
    $email = $request->email;
    $user = User::getUserEmail($email);
    if(empty($user)){
        return back()->withErrors('登録されていません');//config
    }
    $password = $request->password;
    Hash::check($password, $user->password);

    $credentials = ['email' => $email, 'password' => $password];
    if (!Auth::attempt($credentials)) {
        $msg = config('auth.message.error.user.incorrect_pass_mail');
      return back()->withErrors($msg);
    }

    $request->session()->regenerate();
    return redirect()->route('payment.index');//ルーティング変更
  }

}
