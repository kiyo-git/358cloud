<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="format-detection" content="telephone=no">
    <title>@yield('title')</title>
    <meta name="keywords" content="PIST6,自転車,スピード,トーナメント,世界最速,エンタテインメント">
    <!--OGP-->
    {{-- <meta property="og:type" content="website">
    <meta property="og:site_name" content="PIST6オフィシャルサイト">
    <meta property="og:locale" content="ja">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@twitter">
    <meta name="twitter:image" content="https://stg.pist6.com/assets/images/common/ogp/og.jpg"> --}}
    <!--favicon-->
    {{-- <link rel="shortcut icon" href="https://pist6.com/favicon.svg">
    <link rel="apple-touch-icon" sizes="180x180" href="https://pist6.com/apple-touch-icon.png"> --}}
    <!--font-->
    @vite(['resources/css/app.css', 'resources/css/payment/common.css', 'resources/js/app.js', 'resources/js/payment/mdkToken.js'])
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;500&amp;amp;family=Roboto:ital,wght@0,300;0,400;0,500;1,500&amp;amp;family=Roboto+Condensed:wght@700&amp;amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Alegreya:ital,wght@1,400;1,500&amp;amp;display=swap">
    <!--discription-->
    <meta name="description" content="PIST6をご利用になるには、「MIXI M」よりログインしてください。PIST6の観戦チケットは、株式会社MIXIが販売しております。">
    <meta property="og:title" content="ログイン | PIST6オフィシャルサイト">
    <meta property="og:description" content="PIST6をご利用になるには、「MIXI M」よりログインしてください。PIST6の観戦チケットは、株式会社MIXIが販売しております。">
    <meta property="og:url" content="">
    <meta name="twitter:title" content="ログイン | PIST6オフィシャルサイト">
    <meta name="twitter:description" content="PIST6をご利用になるには、「MIXI M」よりログインしてください。PIST6の観戦チケットは、株式会社MIXIが販売しております。">
    <meta name="next-head-count" content="25">
  </head>
  <body>
    @include('auth.include.header-from-news')
    @yield('content')
    @include('auth.include.footer')

    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  </body>
</html>
