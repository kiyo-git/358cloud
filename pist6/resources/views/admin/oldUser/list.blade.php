@extends('admin.app')
@section('title', '旧会員基盤ユーザー画面 - 一覧')
@section('content')
    <p class="content-title">旧会員基盤ユーザー一覧画面</p>
    <table class="table-list w-full text-gray-500 dark:text-gray-400">
        <thead>
            <tr>
                <th>ID</th>
                <th>NAME</th>
                <th>BIRTHDAY</th>
                <th>UPDATE</th>
                <th>TRANSFERED</th>
                <th colspan="2"></th>
            </tr>
        </thead>
        <tbody>
            @if(!$old_users->isEmpty())
                @foreach ($old_users as $user)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="px-6 py-4 text-center">{{ $user->id }}</td>
                        <td class="px-6 py-4 text-center">{{ $user->family_name . ' ' . $user->given_name }}</td>
                        <td class="px-6 py-4 text-center">{{ $user->birthday  }}</td>
                        <td class="px-6 py-4 text-center">@if(isset($user->updated_at)){{ date('Y/m/d H:i:s', strtotime($user->updated_at)) }}@else{{ date('Y/m/d H:i:s', strtotime($user->created_at)) }}@endif</td>
                        <td class="px-6 py-4 text-center">{{ !is_null($user->transfered_at)?date('Y/m/d H:i:s', strtotime($user->transfered_at)):'-'}}</td>
                        <td><a href="{{ route('admin.old-user.show', $user->id) }}">View</a></td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    <div style="margin-top: 3%;">
        {{ $old_users->links('vendor.pagination.admin.tailwind') }}
    </div>
@endsection
