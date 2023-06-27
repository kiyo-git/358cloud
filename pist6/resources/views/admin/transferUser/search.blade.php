@extends('admin.app')
@section('title', 'データ移行新規会員検索画面')
@section('content')
    <form id="search_user" name="form" action="{{ route('admin.transfer-user-search.search') }}" method="get">
        @csrf
        <p class="content-title">データ移行新規会員検索画面</p>
        <div class="form-content">
            <div class="form-group">
                <div class="form-group-label">
                    <label for="id">
                        ユーザーID
                    </label>
                </div>
                <div class="form-group-input">
                    <input type="text" name="id" value="{{ $param['id'] }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-3/4 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
            </div>
            <div class="form-group">
                <div class="form-group-label">
                    <label for="name">
                        氏名
                    </label>
                </div>
                <div class="form-group-input">
                    <input type="text" name="name" id="name" value="{{ $param['name'] }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-3/4 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
            </div>
            <div class="form-group">
                <div class="form-group-label">
                    <label for="name">
                        氏名カナ
                    </label>
                </div>
                <div class="form-group-input">
                    <input type="text" name="name_kana" value="{{ $param['name_kana'] }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-3/4 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
            </div>
            <div class="form-group">
                <div class="form-group-label">
                    <label for="year">
                        生年月日
                    </label>
                </div>
                <div class="form-group-input flex">
                    <input type="text" name="year" value="{{ $param['year'] }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-1/4 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <input type="text" name="month" value="{{ $param['month'] }}" class="bg-gray-50 ml-1 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-1/4 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <input type="text" name="day" value="{{ $param['day'] }}" class="bg-gray-50 ml-1 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-1/4 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
            </div>
            <div class="form-group">
                <div class="form-group-label">
                    <label for="email">
                        メールアドレス
                    </label>
                </div>
                <div class="form-group-input">
                    <input type="text" name="email" id="email" value="{{ $param['email'] }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-3/4 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
            </div>
            <div class="form-group">
                <div class="form-group-label">
                    <label for="zip_code">
                        郵便番号
                    </label>
                </div>
                <div class="form-group-input">
                    <input type="text" name="zip_code" value="{{ $param['zip_code'] }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-1/4 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
            </div>
            <div class="form-group">
                <div class="form-group-label">
                    <label for="phone_number">
                        電話番号
                    </label>
                </div>
                <div class="form-group-input">
                    <input type="text" name="phone_number" value="{{ $param['phone_number'] }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-3/4 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
            </div>
            <div class="form-group">
                <div class="form-group-label">
                    <label for="tel">
                        会員種別
                    </label>
                </div>
                <div class="form-group-input">
                    <select name="transfer_flg" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-3/4 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="">
                        <option value="" @if($param['transfer_flg'] == '') selected @endif>全て</option>
                        <option value="0" @if($param['transfer_flg'] == '0') selected @endif>新規会員登録</option>
                        <option value="1" @if($param['transfer_flg'] == '1') selected @endif>データ移行ユーザー</option>
                    </select>
                </div>
            </div>
        </div>
        @if(isset($user->id))<input type="hidden" name="id" value="{{ $user->id }}">@endif
    </form>
    <form id="download" name="form" action="{{ route('admin.transfer-user-search.download') }}" method="post">@csrf</form>
        <div class="text-center mt-3 w-100">
            <button  form="search_user" type="submit" class="primary-button w-1/2 text-center bg-gray-800 border border-transparent rounded-md font-semibold text-white uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                検索
            </button>
            <button form="download" type="submit" class="secondary-button text-center bg-white border border-gray-300 rounded-md font-semibold text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                CSVダウンロード
            </button>
        </div>
    <div style="margin-top: 3%;">
        <table class="table-list w-full text-gray-500 dark:text-gray-400">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NAME</th>
                    <th>TRANSFER DATE</th>
                    <th>UPDATE</th>
                    <th colspan="2"></th>
                </tr>
            </thead>
            <tbody>
                @if(!$users->isEmpty())
                    @foreach ($users as $user)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="px-6 py-4 text-center">{{ $user->id }}</td>
                            <td class="px-6 py-4">{{ $user->family_name . ' ' . $user->given_name }}</td>
                            <td class="px-6 py-4 text-center">{{ date('Y/m/d H:i:s', strtotime($user->transfered_at)) }}</td>
                            <td class="px-6 py-4 text-center">@if(isset($user->updated_at)){{ date('Y/m/d H:i:s', strtotime($user->updated_at)) }}@else{{ date('Y/m/d H:i:s', strtotime($user->created_at)) }}@endif</td>
                            <td><a href="{{ route('admin.transfer-user.show', [$user->id,'prev']) }}">View</a></td>
                            <td><a href="{{ route('admin.transfer-user.edit', [$user->id,'prev']) }}">Edit</a></td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
        <div style="margin-top: 3%;">
            {{ $users->links('vendor.pagination.admin.tailwind') }}
        </div>
    </div>
@endsection
