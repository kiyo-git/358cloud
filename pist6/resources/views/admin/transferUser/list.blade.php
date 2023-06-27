@extends('admin.app')
@section('title', 'データ移行新規会員画面 - 一覧')
@section('content')
    <form action="{{ route('admin.admin-user.create') }}" method="get">
        <p class="content-title">データ移行新規会員一覧画面</p>
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
                            <td><a href="{{ route('admin.transfer-user.show', $user->id) }}">View</a></td>
                            <td><a href="{{ route('admin.transfer-user.edit', $user->id) }}">Edit</a></td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
        <div style="margin-top: 3%;">
            {{ $users->links('vendor.pagination.admin.tailwind') }}
        </div>
    </form>
@endsection
