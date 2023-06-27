<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OldProfile extends Model
{

    protected $table = 'old_profiles';

    protected $guarded = ['id'];

    /**
     * Ruby API代替(電話番号から旧会員検索)
     * @param $phone_number
     */
    public static function findUserByPhone($phone_number)
    {
        return OldProfile::join('old_users', 'old_profiles.user_id', '=', 'old_users.id')
                        ->where('old_profiles.phone_number', $phone_number)
                        ->first();
    }

    /**
     * Ruby API代替(メールアドレスから旧会員検索)
     * @param $email
     */
    public static function findUserByEmail($email)
    {
        return OldProfile::join('old_users', 'old_profiles.user_id', '=', 'old_users.id')
                        ->where('old_profiles.email', $email)
                        ->first();
    }

}
