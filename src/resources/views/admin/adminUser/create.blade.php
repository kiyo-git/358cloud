@extends('admin.app')
@if(Request::routeIs('admin.admin-user.create'))
@section('title', '管理ユーザー画面 - 新規登録')
@elseif(Request::routeIs('admin.admin-user.edit'))
@section('title', '管理ユーザー画面 - 編集')
@endif
@section('content')
    <form name="form" action="{{ route('admin.admin-user.create') }}" method="post">
        @csrf
        <p class="content-title">@if(Request::routeIs('admin.admin-user.create'))管理ユーザー新規登録画面@elseif(Request::routeIs('admin.admin-user.edit'))管理ユーザー編集画面@endif</p>
        <div class="form-content">
            <div class="form-group">
                <div class="form-group-label">
                    <label for="name">
                        名前
                        <p class="error-text">
                            @if($errors->has('name'))
                                {{ $errors->first('name') }}
                            @endif
                        </p>
                    </label>
                </div>
                <div class="form-group-input">
                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-3/4 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
            </div>
            <div class="form-group">
                <div class="form-group-label">
                    <label for="email">
                        メールアドレス
                        <p class="error-text">
                            @if($errors->has('email'))
                                {{ $errors->first('email') }}
                            @endif
                        </p>
                    </label>
                </div>
                <div class="form-group-input">
                    <input type="text" name="email" id="email" value="{{ old('email', $user->email) }}" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-3/4 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
            </div>
            <div class="form-group">
                <div class="form-group-label">
                    <label for="password">
                        パスワード
                        <p class="error-text">
                            @if($errors->has('password'))
                                {{ $errors->first('password') }}
                            @endif
                        </p>
                    </label>
                </div>
                <div class="form-group-input">
                    <input type="password" name="password" id="password" value="{{ old('password') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-3/4 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
            </div>
            <div class="form-group">
                <div class="form-group-label">
                    <label for="role">
                        権限
                        <p class="error-text">
                            @if($errors->has('role'))
                                {{ $errors->first('role') }}
                            @endif
                        </p>
                    </label>
                </div>
                <div class="form-group-input" style="border-bottom: 0;">
                    <label for="role-admin" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300 p-1">
                        <input type="radio" name="role" id="role-admin" value="1" {{ old('role') == '' || old('role', $user->role) == '1' ? 'checked' : '' }} class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 mr-1">
                        管理者
                    </label>
                    <label for="role-user" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300 p-1">
                        <input type="radio" name="role" id="role-user" value="2" {{ old('role', $user->role) == '2' ? 'checked' : '' }} class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 mr-1">
                        運用者
                    </label>
                </div>
            </div>
        </div>
        @if(Request::routeIs('admin.admin-user.edit'))<input type="hidden" name="id" value="{{ $user->id }}">@endif
        <div style="width: 100%; margin-top:3%;">
            <button type="button" onclick="window.location='/admin/admin-user'" class="secondary-button ml-4 px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                一覧に戻る
            </button>
            <button type="submit" id="createBtn" class="primary-button ml-4 px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-white uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                @if(Request::routeIs('admin.admin-user.create'))登録@elseif(Request::routeIs('admin.admin-user.edit'))更新@endif
            </button>
        </div>
    </form>
@endsection