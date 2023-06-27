<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Hash;
use App\Notifications\ResetPasswordJP as ResetPasswordNotificationJP;
use Illuminate\Support\Facades\Password;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    const NEWSLETTER = [
        0 => '未登録',
        1 => '登録',
    ];

    protected $table = 'users';

    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];


    public function findUser($id)
    {
        return $this->find($id);
    }

    public function getUserList()
    {
        return $this->orderBy('id')->paginate(config('admin.common.pagination'));
    }

    public function getUserListBySearch($param)
    {
        // 初期クエリ
        $users = $this->query();

        /**
         * 条件追加
         */
        // ユーザーID
        if (isset($param['id'])) $users->where('id', 'LIKE', '%' . addcslashes($param['id'], '%_\\') . '%');

        // 氏名
        if (isset($param['name'])) {
            $users->where(function ($query) use ($param) {
                $query->where('family_name', 'LIKE', '%' . addcslashes($param['name'], '%_\\') . '%')
                    ->orWhere('given_name', 'LIKE', '%' . addcslashes($param['name'], '%_\\') . '%');
            });
        }

        // 氏名カナ
        if (isset($param['name_kana'])) {
            $users->where(function ($query) use ($param) {
                $query->where('family_name_kana', 'LIKE', '%' . addcslashes($param['name_kana'], '%_\\') . '%')
                    ->orWhere('given_name_kana', 'LIKE', '%' . addcslashes($param['name_kana'], '%_\\') . '%');
            });
        }

        // 生年月日
        if (isset($param['year'])) $users->whereRaw("DATE_FORMAT(birthday,'%Y') LIKE ?", ['%' . addcslashes($param['year'], '%_\\') . '%']);
        if (isset($param['month'])) $users->whereRaw("DATE_FORMAT(birthday,'%m') LIKE ?", ['%' . addcslashes($param['month'], '%_\\') . '%']);
        if (isset($param['day'])) $users->whereRaw("DATE_FORMAT(birthday,'%d') LIKE ?", ['%' . addcslashes($param['day'], '%_\\') . '%']);

        // メールアドレス
        if (isset($param['email'])) $users->where('email', 'LIKE', '%' . addcslashes($param['email'], '%_\\') . '%');

        // 郵便番号
        if (isset($param['zip_code'])) $users->where('zip_code', 'LIKE', '%' . addcslashes($param['zip_code'], '%_\\') . '%');

        // 電話番号
        if (isset($param['phone_number'])) $users->where('phone_number', 'LIKE', '%' . addcslashes($param['phone_number'], '%_\\') . '%');

        // 会員種別
        if (isset($param['transfer_flg']) && $param['transfer_flg'] != '') $users->join('user_certifications', 'users.id', '=', 'user_certifications.user_id')->where('type', '=', $param['transfer_flg']);

        return $users;
    }

    public function countEmail($email){
        return $this->where('email', 'like', '%'.$email.'%')
        ->count();
    }

    public function deleteUser($id,$email)
    {
        $user = $this->find($id);

        $user->email = $email;
        $user->deleted_at = Carbon::now();

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

    /**
     * ユーザー名のみを取得する関数
     * @param string $id
     * @return string $name
     */
    public function getName($id)
    {
        $divided_name = $this->select('family_name', 'given_name')->find($id);

        return $divided_name->family_name . ' ' . $divided_name->given_name;
    }

    /**
     * insert
     */
    public static function Insert($insert_items)
    {
        return User::create([
            'email' => $insert_items->email,
            'password' =>  Hash::make($insert_items->password),
            // 'remember_token' => $insert_items->remember_token,
            'family_name' => $insert_items->family_name,
            'given_name' => $insert_items->given_name,
            'family_name_kana' => $insert_items->family_name_kana,
            'given_name_kana' => $insert_items->given_name_kana,
            'birthday' => $insert_items->birth,
            'phone_number' => $insert_items->phone_number,
            'zip_code' => $insert_items->zip_code,
            'prefecture' => $insert_items->prefecture,
            'city' => $insert_items->city,
            'block' => $insert_items->block,
            'building' => $insert_items->buliding,
            'mailmagazine_flg' => $insert_items->mailmagazine,
            'ng_user_check' => $insert_items->user_check??0,
            'qr_user_id' => $insert_items->qr_user_id??null,
        ]);
    }

    public static function getUserEmail($email){
        return User::where('email',$email)
        ->first();
    }

    public static function updateUser($insert_items){
        $user = User::find($insert_items->id);

        $user->family_name = $insert_items->family_name;
        $user->given_name = $insert_items->given_name;
        $user->family_name_kana = $insert_items->family_name_kana;
        $user->given_name_kana = $insert_items->given_name_kana;
        $user->birthday = $insert_items->birth;
        $user->phone_number = $insert_items->phone_number;
        $user->zip_code = $insert_items->zip_code;
        $user->prefecture = $insert_items->prefecture;
        $user->city = $insert_items->city;
        $user->block = $insert_items->block;
        $user->building = $insert_items->buliding??null;
        $user->email = $insert_items->email;
        $user->mailmagazine_flg = $insert_items->mailmagazine_flg;
        $user->updated_at = Carbon::now();

        $upd_columns = $user->getDirty();

        $user->save();

        return $upd_columns;

    }


    public function sendPasswordResetNotification($token)
    {
        // $this->notify(new ResetPasswordNotification($token));
        $this->notify(new ResetPasswordNotificationJP($token));
    }
}
