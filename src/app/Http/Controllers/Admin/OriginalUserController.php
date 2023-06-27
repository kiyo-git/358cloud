<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OldUser;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Log;

// todo: 実装メモ↓
// 元会員基盤との接続に関しては、feat/integrate-to-current-systemブランチのOriginalAccountController.phpが流用可能
// DBではなくAPIから取得する都合上、ページネーションを自前で制御する必要があったので念のためメモ
class OriginalUserController extends Controller
{
    protected OldUser $OldUser;

    public function __construct(OldUser $OldUser)
    {
        $this->OldUser = $OldUser;
    }

    /**
     * 一覧表示
     *
     */
    public function index()
    {
        try {
            $original_users = $this->OldUser->getListJoinProfile();
            return view('admin.originalUser.list', compact('original_users'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            exit(config('admin.message.error.original_user.list'));
        }
    }

    /**
     * 詳細画面
     *
     * @param int $id
     * @return Application|Factory|View|void
     */
    public function show(int $id)
    {
        try {
            $original_user = $this->OldUser->findOldUserJoinProfile($id);
            return view('admin.originalUser.show', compact('original_user'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            exit(config('admin.message.error.original_user.detail'));
        }
    }
}
