@extends('admin.app')
@section('title', '旧会員基盤ユーザー画面 - 詳細')
@section('content')
    <p class="content-title">旧会員基盤ユーザー詳細画面</p>
    <div class="form-content">
        <div class="form-group">
            <div class="form-group-label">
                <label>
                    ID
                </label>
            </div>
            <div class="form-group-input">
                {{ $old_user->id }}
            </div>
        </div>
        <div class="form-group">
            <div class="form-group-label">
                <label>
                    名前（姓）
                </label>
            </div>
            <div class="form-group-input">
                {{ $old_user->oldProfile->family_name }}
            </div>
        </div>
        <div class="form-group">
            <div class="form-group-label">
                <label>
                    名前（名）
                </label>
            </div>
            <div class="form-group-input">
                {{ $old_user->oldProfile->given_name }}
            </div>
        </div>
        <div class="form-group">
            <div class="form-group-label">
                <label>
                    フリガナ（姓）
                </label>
            </div>
            <div class="form-group-input">
                {{ $old_user->oldProfile->family_name_kana }}
            </div>
        </div>
        <div class="form-group">
            <div class="form-group-label">
                <label>
                    フリガナ（名）
                </label>
            </div>
            <div class="form-group-input">
                {{ $old_user->oldProfile->given_name_kana }}
            </div>
        </div>
        <div class="form-group">
            <div class="form-group-label">
                <label>
                    生年月日
                </label>
            </div>
            <div class="form-group-input">
                {{ $old_user->oldProfile->birthday }}
            </div>
        </div>
        <div class="form-group">
            <div class="form-group-label">
                <label>
                    電話番号
                </label>
            </div>
            <div class="form-group-input">
                {{ $old_user->oldProfile->phone_number }}
            </div>
        </div>
        <div class="form-group">
            <div class="form-group-label">
                <label>
                    郵便番号
                </label>
            </div>
            <div class="form-group-input">
                {{ $old_user->oldProfile->zip_code }}
            </div>
        </div>
        <div class="form-group">
            <div class="form-group-label">
                <label>
                    住所[都道府県]
                </label>
            </div>
            <div class="form-group-input">
                {{ $old_user->oldProfile->prefecture }}
            </div>
        </div>
        <div class="form-group">
            <div class="form-group-label">
                <label>
                    住所[市区町村]
                </label>
            </div>
            <div class="form-group-input">
                {{ $old_user->oldProfile->city }}
            </div>
        </div>
        <div class="form-group">
            <div class="form-group-label">
                <label>
                    住所[番地]
                </label>
            </div>
            <div class="form-group-input">
                {{ $old_user->oldProfile->address_line }}
            </div>
        </div>
        <div class="form-group">
            <div class="form-group-label">
                <label>
                    住所[マンション名・号室]
                </label>
            </div>
            <div class="form-group-input">
                {{ $old_user->oldProfile->building }}
            </div>
        </div>
        <div class="form-group">
            <div class="form-group-label">
                <label for="email">
                    メールアドレス
                </label>
            </div>
            <div class="form-group-input">
                {{ $old_user->oldProfile->email }}
            </div>
        </div>
        <div class="form-group">
            <div class="form-group-label">
                <label for="email">
                    メルマガ登録
                </label>
            </div>
            <div class="form-group-input">
                {{ App\Models\User::NEWSLETTER[$old_user->oldProfile->mailmagazine] }}
            </div>
        </div>
        <div class="form-group">
            <div class="form-group-label">
                <label for="transfered_at">
                    移行日時
                </label>
            </div>
            <div class="form-group-input">
                {{ !is_null($old_user->transfered_at)?date('Y/m/d H:i:s', strtotime($old_user->transfered_at)):null}}
            </div>
        </div>
    </div>
    <div class="text-center mt-3 w-100">
        <button type="button" onclick="window.location='/admin/old-user'" class="secondary-button ml-4 px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
            一覧に戻る
        </button>
    </div>
@endsection
