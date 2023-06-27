@extends('admin.app')
@section('title', 'Dashboard画面')
@section('content')
    <p class="content-title">Dashboard</p>
    {{-- ↓↓↓　権限が「管理者」のみ表示　↓↓↓ --}}
    @isset($change_logs)
        <table class="table-list w-full text-gray-500 dark:text-gray-400">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>ADMIN NAME</th>
                    <th>CONTENT</th>
                    <th>UPDATE ID</th>
                    <th>DETAIL</th>
                    <th>TYPE</th>
                </tr>
            </thead>
            <tbody>
                @if(!$change_logs->isEmpty())
                    @foreach ($change_logs as $change_log)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="px-6 py-4 text-center">{{ $change_log->id }}</td>
                            <td class="px-6 py-4">{{ $change_log->adminUser->name }}</td>
                            <td class="px-6 py-4">{{ App\Models\ChangeLog::TABLES[$change_log->table] }}</td>
                            <td class="px-6 py-4">{{ $change_log->target_id }}</td>
                            <td class="px-6 py-4">@if($change_log->type != App\Models\ChangeLog::TYPE_CREATE){{ $change_log->columns_name }}@endif</td>
                            <td class="px-6 py-4">{{ App\Models\ChangeLog::TYPE[$change_log->type] }}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    @endisset
@endsection