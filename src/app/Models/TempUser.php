<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TempUser extends Model
{

    protected $table = 'temp_users';

    protected $guarded = ['id'];
    const UPDATED_AT = null;

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];


    public static function Insert($insert_items)
    {
        $parm =[
            'user_certification_id' =>$insert_items->user_certification_id,
            'email' => $insert_items->email,
            'password' => $insert_items->password,
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
        ];
        return TempUser::updateOrCreate(['email'=>$insert_items->email],$parm);
    }

    public static function getUser($email){
        return TempUser::where('email',$email)
        ->first();
    }


}
