<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OldUser extends Model
{
    use HasFactory;

    protected $table = 'old_users';

    /**
     * 1件取得
     * 「old_profiles」と結合
     */
    public function findOldUserJoinProfile($id)
    {
        return OldUser::where('old_users.id',$id)
            ->join('old_profiles', 'old_users.id', '=', 'old_profiles.user_id')
            ->leftjoin('user_certifications','old_users.id','=','user_certifications.old_user_id')
            ->select('old_users.*','old_profiles.*','user_certifications.transfered_at')
            ->first();
    }

    /**
     * 一覧取得
     * 「old_profiles」と結合
     */
    public function getListJoinProfile()
    {
        return $this->join('old_profiles', 'old_users.id', '=', 'old_profiles.user_id')
                    ->leftjoin('user_certifications','old_users.id','=','user_certifications.old_user_id')
                    ->select('old_users.*','old_profiles.*','user_certifications.transfered_at')
                    ->orderBy('old_users.id')
                    ->paginate(config('admin.common.pagination'));
    }

    /**
     * hasOneリレーション
     * 「old_profiles」と結合
     */
    public function oldProfile()
    {
        return $this->hasOne(OldProfile::class, 'user_id');
    }
}
