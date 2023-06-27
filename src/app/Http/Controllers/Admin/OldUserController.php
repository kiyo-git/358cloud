<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OldUser;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OldUserController extends Controller
{
    protected $OldUser;

    public function __construct(OldUser $OldUser)
    {
        $this->OldUser = $OldUser;
    }

    /**
     * 一覧表示
     */
    public function index()
    {
        try {
            $old_users = $this->OldUser->getListJoinProfile();
            return view('admin.oldUser.list', compact('old_users'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            exit(config('admin.message.error.old_user.list'));
        }
    }

    /**
     * 詳細画面
     *
     * @param int $id
     * @return Application|Factory|View|void
     */
    public function show($id)
    {
        try {
            $old_user = $this->OldUser->findOldUserJoinProfile($id);
            return view('admin.oldUser.show', compact('old_user'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            exit(config('admin.message.error.old_user.detail'));
        }
    }
}
