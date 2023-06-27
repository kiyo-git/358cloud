<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;



class AdminUser extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    
    const ROLE = [
        '1' => '管理者',
        '2' => '運営者'
    ];

    use HasFactory;

    protected $table = 'admin_users';

    protected $guarded = ['id'];

    public function findAdminUser($id)
    {
        return $this->find($id);
    }

    public function getAllAdminUser()
    {
        return $this->orderBy('id')->get();
    }

    public function createAdminUser($param)
    {
        return $this->create($param);
    }

    public function updAdminUserById($id, $param)
    {
        $user = $this->find($id);

        $user->name     = $param['name'];
        $user->email    = $param['email'];
        $user->role     = $param['role'];
        if (isset($param['password'])) $user->password = $param['password'];

        $upd_columns = $user->getDirty();

        $user->save();

        return $upd_columns;
    }

    /**
     * 全カラム名取得関数
     *
     * @return array
     */
    public function getColumns()
    {
        $table = $this->getTable();
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($table);
    }
}
