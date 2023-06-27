<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ChangeLog;
use App\Models\AdminUser;

class DashboardController extends Controller
{
    protected $ChangeLog;
    protected $AdminUser;

    public function __construct(ChangeLog $ChangeLog, AdminUser $AdminUser)
    {
        $this->ChangeLog = $ChangeLog;
        $this->AdminUser = $AdminUser;
    }

    public function index()
    {
        $admin_user  = $this->AdminUser->findAdminUser(auth()->id());

        if ( $admin_user->role == 1 ) {
            $change_logs = $this->ChangeLog->getChangeLogs();
            return view('admin.dashboard.index', compact('change_logs'));
        } else {
            return view('admin.dashboard.index');
        }
    }
}
