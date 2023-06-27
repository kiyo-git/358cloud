<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminUser;
use App\Models\ChangeLog;
use App\Http\Requests\Admin\AdminUserStoreRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class AdminUserController extends Controller
{
    protected $AdminUser;
    protected $ChangeLog;

    public function __construct(AdminUser $AdminUser, ChangeLog $ChangeLog)
    {
        $this->AdminUser = $AdminUser;
        $this->ChangeLog = $ChangeLog;
    }

    /**
     * 初期表示
     *
     * @return void
     */
    public function index()
    {
        try {
            $users = $this->AdminUser->getAllAdminUser();
            return view('admin.adminUser.list', compact('users'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            exit(config('admin.message.error.admin_user.list'));
        }
    }

    /**
     * 新規作成画面
     *
     * @return void
     */
    public function create()
    {
        $user = $this->AdminUser;
        return view('admin.adminUser.create', compact('user'));
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
            $user = $this->AdminUser->findAdminUser($id);
            return view('admin.adminUser.create', compact('user'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            exit(config('admin.message.error.admin_user.edit'));
        }
    }

    /**
     * 新規登録・更新
     *
     * @param AdminUserStoreRequest $request
     * @return void
     */
    public function store(AdminUserStoreRequest $request)
    {
        DB::beginTransaction();
        try {
            $param = $request->only(['name', 'email', 'role']);
            if (isset($request->password)) {
                $param['password'] = Hash::make($request->password);
            }

            if (!isset($request->id)) {
                // 新規登録
                $ins_data = $this->AdminUser->createAdminUser($param);

                // 更新ログ登録
                $this->ChangeLog->createChangeLog($this->AdminUser->getTable(), $ins_data->id, $this->ChangeLog::TYPE_CREATE);
            } else {
                // 更新
                $upd_columns = $this->AdminUser->updAdminUserById($request->id, $param);

                // 更新ログ登録
                $this->ChangeLog->createChangeLog($this->AdminUser->getTable(), $request->id, $this->ChangeLog::TYPE_UPDATE, $upd_columns);
            }

            DB::commit();

            return redirect(route('admin.admin-user.list') . '?status=success');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            return redirect(route('admin.admin-user.list') . '?status=error');
        }
    }
}
