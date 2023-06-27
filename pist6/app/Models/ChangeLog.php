<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AdminUser;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ChangeLog extends Model
{
    use HasFactory;

    protected $table = 'change_logs';

    protected $guarded = ['id'];

    protected $casts = [
        'columns'  => 'json',
    ];

    // 任意のカラム追加
    protected $appends = ['columns_name'];  // 更新カラム名格納用

    const TYPE_CREATE = 1;
    const TYPE_UPDATE = 2;
    const TYPE_DELETE = 3;

    const TYPE = [
        self::TYPE_CREATE => '新規登録'
        , self::TYPE_UPDATE => '更新'
        , self::TYPE_DELETE => '削除'
    ];

    // テーブル名取得用定数
    const TABLES = [
        'admin_users' => '管理ユーザー'
        , 'users' => 'データ移行新規会員'
        , 'ticket_order_payments' => 'チケット決済情報'
    ];

    // 更新カラム名取得用定数
    const COLUMNS_NAME = [
        'users' => [
            'family_name'       => '名前（姓）',
            'given_name'        => '名前（名）',
            'family_name_kana'  => 'フリガナ（姓）',
            'given_name_kana'   => 'フリガナ（名）',
            'birthday'          => '生年月日',
            'phone_number'      => '電話番号',
            'zip_code'          => '郵便番号',
            'prefecture'        => '住所[都道府県]',
            'city'              => '住所[市区町村]',
            'block'             => '住所[番地]',
            'building'          => '住所[マンション名・号室]',
            'email'             => 'メールアドレス',
            'mailmagazine_flg'  => 'メルマガ登録',
            'updated_at'        => '更新日時',
            'deleted_at'        => '削除日時'
        ],
        'admin_users' => [
            'name'          => '名前'
            , 'email'       => 'メールアドレス'
            , 'password'    => 'パスワード'
            , 'role'        => '権限'
        ],
        'ticket_order_payments' => [
            'status'   => '購入ステータス'
            ,'remark'  => '補足'
        ],
    ];

    /**
     * 更新カラム名設定関数
     * 以下命名規則で、取得したデータに任意のデータを追加できる。
     * get + $appendsに設定しているカラム名 + Attribute
     *
     * 【取得方法】
     * $object->$appendsに設定したカラム名
     *
     * @return string
     */
    public function getColumnsNameAttribute()
    {
        $table = $this->attributes['table'];
        $columns = json_decode($this->attributes['columns']);

        foreach ($columns as $column) {
            $columns_name[] = self::COLUMNS_NAME[$table][$column];
        }

        if ( empty($columns_name) ) {
            return false;
        }

        return implode(',', $columns_name);
    }

    public function adminUser()
    {
        return $this->belongsTo(AdminUser::class);
    }

    public function getChangeLogs()
    {
        return $this->with('adminUser')->orderBy('id', 'desc')->get();
    }

    /**
     * 更新ログ登録関数
     *
     * @param string $table
     * @param int $id
     * @param boolean $update_flg
     * @param array $columns
     * @return void
     */
    public function createChangeLog($table, $target_id, $type, $columns = null)
    {
        // インスタンス生成
        $AdminUser  = new AdminUser();
        $User       = new User();
        $TicketOrderPayment    = new TicketOrderPayment();

        // テーブル名から判定
        if ($table == $AdminUser->getTable()) {
            // admin_users（管理ユーザー）
            $param = $this->getChangeLogParam($AdminUser, $target_id, $type, $columns);
        } elseif ($table == $User->getTable()) {
            // users（データ移行新規会員）
            $param = $this->getChangeLogParam($User, $target_id, $type, $columns);
        }elseif ($table == $TicketOrderPayment->getTable()) {
            // users（データ移行新規会員）
            $param = $this->getChangeLogParam($TicketOrderPayment, $target_id, $type, $columns);
        }

        return $this->create($param);
    }

    /**
     * columnsカラムに登録するデータ作成関数
     *
     * @param array $array
     * @return array or null
     */
    public function getUpdColumn($array)
    {
        if (isset($array)) {
            return array_keys($array);
        }

        return null;
    }

    /**
     * 更新ログに登録するデータ作成
     *
     * @param object $model
     * @param int $id
     * @param boolean $update_flg
     * @param array or null $columns
     * @return array
     */
    private function getChangeLogParam($model, $target_id, $type, $columns)
    {
        // テーブルデータ新規登録
        if ($type == self::TYPE_CREATE) {
            return [
                'admin_user_id' => Auth::guard('admin')->user()->id
                , 'table'       => $model->getTable()
                , 'columns'     => $model->getColumns()
                , 'target_id'   => $target_id
                , 'type'        => self::TYPE_CREATE
            ];
        }// テーブルデータ更新時
        elseif ($type == self::TYPE_UPDATE) {
            return [
                'admin_user_id' => Auth::guard('admin')->user()->id
                , 'table'       => $model->getTable()
                , 'columns'     => $this->getUpdColumn($columns)
                , 'target_id'   => $target_id
                , 'type'        => self::TYPE_UPDATE
            ];
        } elseif ($type == self::TYPE_DELETE) {
            return [
                'admin_user_id' => Auth::guard('admin')->user()->id
                , 'table'       => $model->getTable()
                , 'columns'     => $this->getUpdColumn($columns)??['deleted_at']
                // , 'columns'     => ['deleted_at']
                , 'target_id'   => $target_id
                , 'type'        => self::TYPE_DELETE
            ];
        }
    }
}
