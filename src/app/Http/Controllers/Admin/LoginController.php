<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminUser;
use App\Http\Requests\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    // public function __construct()
    // {
    //   $this->middleware('guest:admin')->except('adminLogout');
    // }  
  /**
   * @return view
   */
  public function login()
  {
    return view('admin.login');
  }

  /**
   * @param LoginRequest $request
   * @return view
   */
  public function confirm(LoginRequest $request)
  {
    $email = $request->email;
    $user = AdminUser::where('email', $email)->first();
    if(empty($user)){
        return back()->withErrors('登録ありません');
    }
    Hash::check($request->password, $user->password);

    $credentials = ['email' => $email, 'password' => $request->password];
    if (!Auth::guard('admin')->attempt($credentials,false)) {
      Auth::guard('admin')->logout();
      $request->session()->regenerate();
      return back()->withErrors('登録ありません');//config

    }

    $request->session()->regenerate();
    return redirect()->intended(RouteServiceProvider::ADMIN_HOME);
  }

  /**
   * logout
   */
  public function destroy(Request $request)
  {
    Auth::guard('admin')->logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/admin/login');
  }
}
