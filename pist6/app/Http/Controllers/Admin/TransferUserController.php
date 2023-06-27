<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ChangeLog;
use App\Http\Requests\Admin\TransferUserDeleteRequest;
use App\Http\Requests\Admin\TransferUserUpdateRequest;
use App\Mail\TransferMail;
use App\Models\UserCertification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class TransferUserController extends Controller
{
    protected $User;
    protected $ChangeLog;

    public function __construct(User $User, ChangeLog $ChangeLog)
    {
        $this->User = $User;
        $this->ChangeLog = $ChangeLog;
    }

    /**
     * 初期表示関数
     *
     * @return void
     */
    public function index()
    {
        try {
            $users = $this->User->getUserList();
            return view('admin.transferUser.list', compact('users'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            exit(config('admin.message.error.transfer_user.list'));
        }
    }

    /**
     * 詳細画面
     *
     * @param int $id
     * @return void
     */
    public function show($id)
    {
        try {
            $user = $this->User->findUser($id);
            $old_user = UserCertification::findUserByUserId($id);
            $user->old_user_id = empty($old_user)?null:$old_user->old_user_id;
            return view('admin.transferUser.show', compact('user'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            exit(config('admin.message.error.transfer_user.detail'));
        }
    }

    /**
     * 編集画面
     *
     * @param int $id
     * @return void
     */
    public function edit($id)
    {
        try {
            $user = $this->User->findUser($id);
            $old_user = UserCertification::findUserByUserId($id);

            [$year, $month, $day] = explode('-', $user->birthday);
            $user->year  = $year;
            $user->month = $month;
            $user->day   = $day;
            $user->old_user_id = empty($old_user)?null:$old_user->old_user_id;

            return view('admin.transferUser.show', compact('user'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            exit(config('admin.message.error.transfer_user.edit'));
        }
    }

    public function update(TransferUserUpdateRequest $request)
    {
        DB::beginTransaction();
        try {
            $back = back()->getTargetUrl();
            $insert_items = (object)$request->all();
            if($insert_items->email != $request->old_email){
                $user = User::getUserEmail($insert_items->email);
                if($user){
                    return redirect()->back()->withErrors('すでに登録されているメールアドレスです。');
                }
            }
            $insert_items->birth = $insert_items->year.'-'.$insert_items->month.'-'.$insert_items->day;
            $upd_columns = User::updateUser($insert_items);

            // 更新ログ登録
            $this->ChangeLog->createChangeLog($this->User->getTable(), $request->id, $this->ChangeLog::TYPE_UPDATE, $upd_columns);
            DB::commit();

            return redirect($back. '?status=success');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            return redirect($back . '?status=error');
        }
    }

    /**
     * 削除関数
     *
     * @param TransferUserDeleteRequest $request
     * @return void
     */
    public function delete(TransferUserDeleteRequest $request)
    {
        DB::beginTransaction();
        try {
            $email_count = $this->User->countEmail($request->email);
            $email = $request->email.'_disabledx'.$email_count;
            $upd_columns = $this->User->deleteUser($request->id,$email);

            // 更新ログ登録
            $this->ChangeLog->createChangeLog($this->User->getTable(), $request->id, $this->ChangeLog::TYPE_DELETE,$upd_columns);

            DB::commit();

            return redirect(route('admin.transfer-user.list') . '?status=success.delete');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            return redirect(route('admin.transfer-user.list') . '?status=error.delete');
        }
    }
}
