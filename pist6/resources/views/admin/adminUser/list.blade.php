@extends('admin.app')
@section('title', 'データ移行ユーザー画面 - 一覧')
@section('content')
    <form action="{{ route('admin.admin-user.create') }}" method="get">
        <p class="content-title">管理ユーザー一覧画面</p>
        <div align="right" style="margin-right: 5%; margin-bottom: 2%;">
            <button type="submit" class="primary-button ml-4 px-4 py-2 border border-transparent rounded-md font-semibold text-white uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                新規登録
            </button>
        </div>
        <table class="table-list w-full text-gray-500 dark:text-gray-400">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NAME</th>
                    <th>EMAIL</th>
                    <th>ROLE</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @if(!$users->isEmpty())
                    @foreach ($users as $user)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="px-6 py-4 text-center">{{ $user->id }}</td>
                            <td class="px-6 py-4">{{ $user->name }}</td>
                            <td class="px-6 py-4">{{ $user->email }}</td>
                            <td class="px-6 py-4">{{ App\Models\AdminUser::ROLE[$user->role] }}</td>
                            <td class="px-6 py-4"><a href="{{ route('admin.admin-user.edit', $user->id) }}">Edit</a></td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </form>
@endsection