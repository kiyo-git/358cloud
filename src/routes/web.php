<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\LoginController as AdminLoginController;
use App\Http\Controllers\Admin\OldUserController;
use App\Http\Controllers\Admin\OriginalUserController;
use App\Http\Controllers\Admin\TransferUserController;
use App\Http\Controllers\Admin\TransferUserSearchController;
use App\Http\Controllers\Admin\PaymentSearchController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\NewUser\RegisterController as NewUserRegisterController;
use App\Http\Controllers\Auth\NewUser\VerifyEmailController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Payment\MenuController;
use App\Http\Controllers\Payment\MethodController;
use App\Http\Controllers\Payment\MpiController;
use App\Http\Controllers\Payment\NetBankController;
use App\Http\Controllers\Payment\PaypayController;
use App\Http\Controllers\Payment\PushController;
use App\Http\Controllers\Auth\Transfer\MailSentController;
use App\Http\Controllers\Auth\Transfer\RegisterController;
use App\Http\Controllers\Auth\Transfer\VerifySMSController;
use App\Http\Controllers\ErrorController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/error', [ErrorController::class, 'show'])->name('error');

Route::group(['middleware' => ['guest']], function () {
    Route::get('/login', [LoginController::class, 'login'])->name('login');
    Route::post('/login/confirm', [LoginController::class, 'confirm'])->name('login.confirm');
    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
    Route::view('/pwd/reset/complete','auth.password-complete')->name('pwd.comp');
    // Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    // Route::post('/login', [AuthenticatedSessionController::class, 'store']);

    Route::prefix('transfer')->group(function () {
        Route::get('/sms/entry', [VerifySMSController::class, 'show'])->name('transfer.sms.entry');
        Route::get('/sms/entry/news', [VerifySMSController::class, 'showFromNews'])->name('transfer.sms.entry.from-news');
        Route::post('/sms/cert', [VerifySMSController::class, 'verify'])->name('transfer.sms.cert');
        Route::get('/sms/cert', [VerifySMSController::class, 'showVerifySMS'])->name('transfer.showVerifySMS');
        Route::post('/register', [VerifySMSController::class, 'verifycheck'])->name('transfer.register');
        Route::get('/register', [VerifySMSController::class, 'registerView'])->name('transfer.register.view');
        Route::get('/email/cert', [MailSentController::class, 'entryEmail'])->name('transfer.email.entry');
        Route::post('/confirm', [RegisterController::class, 'confirm'])->name('transfer.confirm');
        Route::get('/confirm/token={token}', [RegisterController::class, 'confirmEmail'])->name('transfer.email.confirm');
        Route::post('/complete/insert', [RegisterController::class, 'complete'])->name('transfer.complete');
       // Route::get('/error', [VerifySMSController::class, 'show'])->name('transfer.error');

    });
    Route::prefix('user')->group(function(){
        Route::get('/email/input', [VerifyEmailController::class, 'show'])->name('user.email.input');
        Route::post('/email/sent', [VerifyEmailController::class, 'sent'])->name('user.email.sent');
        // Route::get('/pwd/input', [VerifySMSController::class, 'show'])->name('user.pwd.input');
        Route::get('/register/token={token}', [VerifyEmailController::class, 'verify'])->name('user.register');
        Route::get('/register', [NewUserRegisterController::class, 'registerView'])->name('user.register.view');
        Route::post('/confirm', [NewUserRegisterController::class, 'confirm'])->name('user.confirm');
        Route::post('/complete/insert', [NewUserRegisterController::class, 'complete'])->name('user.complete');

        Route::get('/pwd/reset', [PasswordResetLinkController::class, 'create'])->name('user.pwd.reset');
    });

});

Route::group(['middleware' => ['auth']], function () {

    Route::get('user/complete', [NewUserRegisterController::class, 'showComplete'])->name('user.show.complete');
    Route::get('transfer/complete', [RegisterController::class, 'showComplete'])->name('transfer.show.complete');

    Route::prefix('payment')->group(function () {
        /**
         * 購入内容の確認
         * 支払い方法の選択
         */
        Route::get('/menu', [MenuController::class, 'index'])->name('payment.index');
        Route::post('/method', [MethodController::class, 'index'])->name('payment.method');

        /**
         * クレジットカード（3D認証）
         */
        Route::get('/mpi', [MpiController::class, 'index'])->name('payment.mpi.entry');
        Route::post('/mpi', [MpiController::class, 'mpiAuthorize'])->name('payment.mpi.authorize');
        // Route::post('/mpi/result', [MpiController::class, 'result'])->name('payment.mpi.result');
        Route::delete('/mpi/remove-card', [MpiController::class, 'removeCard'])->name('payment.mpi.remove-card');

        /**
         * ネットバンク
         */
        Route::get('/netbank', [NetBankController::class, 'netbankAuthorize'])->name('payment.netbank.entry');

        /**
         * PayPay
         */
        Route::get('/paypay', [PaypayController::class, 'paypayAuthorize'])->name('payment.paypay.entry');
        Route::get('/paypay/result', [PaypayController::class, 'result'])->name('payment.paypay.result');
    });
});

/**
 * 決済結果通知エンドポイント
 */
Route::prefix('payment')->group(function () {
    Route::post('/mpi/relay', [MpiController::class, 'relay'])->name('payment.mpi.relay');
    Route::post('/netbank/thanks', [NetBankController::class, 'thanks'])->name('payment.netbank.thanks');
    Route::post('/netbank/push', [PushController::class, 'netbank'])->name('payment.netbank.push');
    Route::post('/paypay/push', [PushController::class, 'paypay'])->name('payment.paypay.push');
});

Route::group(['middleware' => ['guest']], function () {
    Route::get('/admin/login', [AdminLoginController::class, 'login'])->name('admin.login');
    Route::post('/admin/login/confirm', [AdminLoginController::class, 'confirm'])->name('admin.login.confirm');
});

Route::group(['middleware' => ['auth:admin']], function () {


    Route::prefix('admin')->group(function () {
        /**
         * Logout
         */
        Route::post('/admin/logout', [AdminLoginController::class, 'destroy'])->name('admin.logout');

        /**
         * Dashboard
         */
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard.index');

        /**
         * 管理ユーザー
         */
        Route::get('/admin-user', [AdminUserController::class, 'index'])->name('admin.admin-user.list');
        Route::get('/admin-user/store', [AdminUserController::class, 'create'])->name('admin.admin-user.create');
        Route::get('/admin-user/store/{id}', [AdminUserController::class, 'edit'])->name('admin.admin-user.edit');
        Route::post('/admin-user/store', [AdminUserController::class, 'store'])->name('admin.admin-user.store');

        /**
         * データ移行新規会員一覧
         */
        Route::get('/transfer-user', [TransferUserController::class, 'index'])->name('admin.transfer-user.list');
        Route::get('/transfer-user/show/{id}/{prev?}', [TransferUserController::class, 'show'])->name('admin.transfer-user.show');
        Route::get('/transfer-user/edit/{id}/{prev?}', [TransferUserController::class, 'edit'])->name('admin.transfer-user.edit');
        Route::post('/transfer-user/update', [TransferUserController::class, 'update'])->name('admin.transfer-user.update');
        Route::post('/transfer-user/delete', [TransferUserController::class, 'delete'])->name('admin.transfer-user.delete');

        /**
         * データ移行新規会員検索
         */
        Route::get('/transfer-user-search', [TransferUserSearchController::class, 'index'])->name('admin.transfer-user-search.list');
        Route::get('/transfer-user-search/search', [TransferUserSearchController::class, 'search'])->name('admin.transfer-user-search.search');
        Route::post('/transfer-user-search/download', [TransferUserSearchController::class, 'download'])->name('admin.transfer-user-search.download');

        /**
         * 購入履歴
         */
        Route::get('/payment/list', [PaymentSearchController::class, 'index'])->name('admin.payment.list');
        Route::get('/payment/show/{id}', [PaymentSearchController::class, 'show'])->name('admin.payment.show');
        Route::post('/payment/update/status', [PaymentSearchController::class, 'updStatus'])->name('admin.payment.update');
        Route::post('/payment/download', [PaymentSearchController::class, 'download'])->name('admin.payment.download');
        Route::get('/payment/search', [PaymentSearchController::class, 'search'])->name('admin.payment.search');
        Route::get('/payment/clear', [PaymentSearchController::class, 'clear'])->name('admin.payment.clear');

        /**
        * 旧会員基盤ユーザー
        */
        Route::get('/old-user', [OldUserController::class, 'index'])->name('admin.old-user.list');
        Route::get('/old-user/show/{id}', [OldUserController::class, 'show'])->name('admin.old-user.show');

        /**
         * 元会員基盤ユーザー
         */
        Route::get('/original-user', [OriginalUserController::class, 'index'])->name('admin.original-user.list');
        Route::get('/original-user/show/{id}', [OriginalUserController::class, 'show'])->name('admin.original-user.show');
    });
});

require __DIR__.'/auth.php';
