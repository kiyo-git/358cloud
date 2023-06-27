<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/admin/style.css', 'resources/js/admin/common.js'])
    @if(Request::routeIs('admin.transfer-user*.*')) @vite(['resources/js/admin/transferUser.js']) @endif
    @if(Request::routeIs('admin.admin-user.*')) @vite(['resources/js/admin/adminUser.js']) @endif
    @if(Request::routeIs('admin.payment.*')) @vite(['resources/js/admin/payment.js']) @endif
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
</head>
<body>
    <div class="app">
        @include('admin.include.header')
        <div class="main">
            @include('admin.include.sidebar')
            <div class="content">
                <div class="flex-content">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
</body>
</html>