<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="format-detection" content="telephone=no">
    <title>{{ config('pist6.error.tab') }}</title>
    <meta name="keywords" content="PIST6,自転車,スピード,トーナメント,世界最速,エンタテインメント">

    @vite([ 'resources/css/payment/common.css', 'resources/js/app.js', 'resources/js/payment/mdkToken.js'])
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
    <header class="l-header root_header _fixed has-animate _bg-black">
        <div class="l-header__inner">
          <div class="l-header__container">
            <div class="l-header__logo">
              <div class="c-header-logo"><a class="c-header-logo__link" aria-label="pist6トップページ" href="https://www.pist6.com">
                  <svg class="c-header-logo__entity" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 630.58 173.797">
                    <g transform="translate(-767.696 -532.396)">
                      <path d="M976.394,560c-6.239-7.435-16.432-11.53-28.7-11.53H900.634L879.839,666.4h23.942l7.814-43.382h23.383c25.058,0,43.166-14.423,47.259-37.638,1.755-9.957-.264-18.732-5.843-25.381m-55.283,9.079H944.49c4.952,0,8.817,1.486,11.177,4.3,2.475,2.948,3.3,7.237,2.39,12.4-1.632,9.263-10.563,16.8-19.907,16.8H915.205Z" transform="translate(82.759 11.861)"></path>
                      <path d="M937.481,666.4h24.111l20.795-117.93H958.275Z" transform="translate(125.297 11.861)"></path>
                      <path d="M1026.713,546.665c-26.214,0-47.775,14.373-51.267,34.174-3.358,19.039,5.329,30.726,26.546,35.721l21.8,5.271c6.33,1.691,13.577,5.395,12.162,13.424-1.557,8.106-12.663,16.146-27.9,15-7.723-.629-13.631-3.327-17.086-7.8a16.608,16.608,0,0,1-3.115-13.026l.256-1.446H964.165l-.179,1.018a34.135,34.135,0,0,0,6.961,27.682c5.127,6.245,15.179,13.774,33.946,14.177q.67.013,1.344.014c23.527,0,49.666-12.948,53.585-35.178,3.332-18.888-6.356-31.864-28.039-37.535l-21.817-5.275c-8.062-2.061-11.636-6.027-10.621-11.79,1.345-7.623,12.187-13.826,24.168-13.826,7.492,0,13.534,2.282,17.01,6.425a13.173,13.173,0,0,1,2.875,10.934l-.255,1.446h24.111l.179-1.018c1.717-9.741-.431-18.794-6.053-25.494-7.082-8.44-19.069-12.9-34.666-12.9" transform="translate(144.45 10.53)"></path>
                      <path d="M1128.749,548.468h-96.194l-3.808,21.6h36.124L1047.885,666.4h23.944l16.985-96.331h36.125Z" transform="translate(192.649 11.861)"></path>
                      <path d="M1160.96,557.707c-5.932-6.566-14.99-9.917-24.848-9.2-24.888,1.854-43.633,23.216-52.784,60.158-5.169,21.394-3.379,39.064,5.037,49.756,5.824,7.4,14.55,11.147,25.938,11.147,22.4,0,42.516-18.237,46.781-42.421,1.886-10.7-.144-20.249-5.715-26.888-5.5-6.557-14.161-10.025-25.041-10.025-6.33,0-14.816,2.857-20.061,6.464,4.849-18.165,15.023-27.125,22.863-27.757,3.18-.243,5.617.417,7.258,1.979,1.943,1.851,2.863,4.978,2.73,9.293l-.038,1.269h23.746l.179-1.018c1.529-8.671-.619-16.754-6.045-22.762m-24.007,70.5c-2.529,14.338-12.338,20.755-20.936,20.755a11.542,11.542,0,0,1-9.123-4.175c-3.1-3.7-4.322-9.488-3.264-15.492,1.856-10.516,10.61-18.445,20.364-18.445,4.394,0,7.95,1.469,10.284,4.253,2.657,3.163,3.606,7.817,2.675,13.1" transform="translate(230.791 11.821)"></path>
                      <path d="M854.595,532.4a86.9,86.9,0,1,0,86.9,86.9A86.9,86.9,0,0,0,854.595,532.4Zm4.48,133.309a43.238,43.238,0,0,1-22.375-6.2l-1.071,6.071H806.663l16.346-92.691h28.965l-1.185,6.721a43.449,43.449,0,1,1,8.287,86.1Z"></path>
                    </g>
                  </svg></a></div>
            </div>
            <div class="l-header__nav">
              <nav class="c-header-nav">
                <ul class="c-header-nav__list">
                  <li class="c-header-nav__item"><a class="c-header-nav__link" href="https://www.pist6.com/news"><span class="c-header-nav__txt">ニュース</span></a></li>
                  <li class="c-header-nav__item"><a class="c-header-nav__link" href="https://www.pist6.com/league/player"><span class="c-header-nav__txt">リーグ / レース</span></a></li>
                  <li class="c-header-nav__item"><a class="c-header-nav__link" href="https://www.pist6.com/player"><span class="c-header-nav__txt">プレイヤー</span></a></li>
                  <li class="c-header-nav__item"><a class="c-header-nav__link" href="https://www.pist6.com/ticket"><span class="c-header-nav__txt">チケット</span></a></li>
                  <li class="c-header-nav__item"><a class="c-header-nav__link" href="https://www.pist6.com/guide"><span class="c-header-nav__txt">ガイド</span></a></li>
                  <li class="c-header-nav__item"><a class="c-header-nav__link" href="https://www.pist6.com/access"><span class="c-header-nav__txt">ドーム</span></a></li>
                  <li class="c-header-nav__item"><a class="c-header-nav__link" href="https://tipstar.com/"><span class="c-header-nav__txt">ベッティング</span></a></li>
                </ul>
              </nav>
            </div>
            <div class="l-header__user">
              <ul class="c-header-user">
                <li class="c-header-user__item"><a class="c-header-user__link" target="_blank" href="/signin"><span class="c-header-user__icon _rock" aria-hidden="true">
                      <svg class="icon icon-rock" id="icon-rock" viewBox="0 0 18 23.5" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" area-hidden="true">
                        <path d="M2099,160h2v12h-18V160c0,0.009,1.99.013,2,0-0.05-5.037-.03-8.056,2-10,1.98-1.982,7.96-2.006,10,0C2099,151.982,2099.01,155.05,2099,160Zm-11,0h8v-7a4.615,4.615,0,0,0-4-2,4.749,4.749,0,0,0-4,2C2088,153.044,2088.02,159.992,2088,160Zm2,4a2.218,2.218,0,0,0,1,2c0.02,0.009.04,2.017,0,2-0.02-.008-1,0.028-1,0,0.01-.044.02,0.966,0,1h4v-1h-1v-2a2.025,2.025,0,0,0,1-2,2.237,2.237,0,0,0-2-2A2.188,2.188,0,0,0,2090,164Z" transform="translate(-2083 -148.5)"></path>
                      </svg></span><span class="c-header-user__txt">マイページ</span></a></li>
                <li class="c-header-user__item"><a class="c-header-user__link" target="_blank" href="/signin?register=true"><span class="c-header-user__icon _login" aria-hidden="true">
                      <svg class="icon icon-login" id="icon-login" viewBox="0 0 12 12" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" area-hidden="true">
                        <path d="M0,11.609A.393.393,0,0,0,.394,12H11.409a.392.392,0,0,0,.394-.391.386.386,0,0,0-.006-.066,5.879,5.879,0,0,0-4.136-5.53,3.283,3.283,0,1,0-3.525,0A5.878,5.878,0,0,0,0,11.609M3.4,3.264A2.5,2.5,0,1,1,5.9,5.745,2.491,2.491,0,0,1,3.4,3.264M5.9,6.527a5.106,5.106,0,0,1,5.1,4.69H.8a5.106,5.106,0,0,1,5.1-4.69"></path>
                      </svg></span><span class="c-header-user__txt">会員登録</span></a></li>
              </ul>
            </div>
            <div class="l-header__menu">
              <button class="c-header-hamburger"><span class="c-header-hamburger__line"><span class="u-visually-hidden">menu</span></span></button>
            </div>
          </div>
        </div>
      </header>
      <header class="bdbox l-header _first-view _clone _bg-gray">
        <div class="l-header__inner">
          <div class="l-header__container">
            <div class="l-header__logo">
              <div class="c-header-logo">
                <h1 class="dib"><a href="https://www.pist6.com/"><svg class="c-header-logo__entity" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 630.58 173.797"><g transform="translate(-767.696 -532.396)"><path d="M976.394,560c-6.239-7.435-16.432-11.53-28.7-11.53H900.634L879.839,666.4h23.942l7.814-43.382h23.383c25.058,0,43.166-14.423,47.259-37.638,1.755-9.957-.264-18.732-5.843-25.381m-55.283,9.079H944.49c4.952,0,8.817,1.486,11.177,4.3,2.475,2.948,3.3,7.237,2.39,12.4-1.632,9.263-10.563,16.8-19.907,16.8H915.205Z" transform="translate(82.759 11.861)"></path><path d="M937.481,666.4h24.111l20.795-117.93H958.275Z" transform="translate(125.297 11.861)"></path><path d="M1026.713,546.665c-26.214,0-47.775,14.373-51.267,34.174-3.358,19.039,5.329,30.726,26.546,35.721l21.8,5.271c6.33,1.691,13.577,5.395,12.162,13.424-1.557,8.106-12.663,16.146-27.9,15-7.723-.629-13.631-3.327-17.086-7.8a16.608,16.608,0,0,1-3.115-13.026l.256-1.446H964.165l-.179,1.018a34.135,34.135,0,0,0,6.961,27.682c5.127,6.245,15.179,13.774,33.946,14.177q.67.013,1.344.014c23.527,0,49.666-12.948,53.585-35.178,3.332-18.888-6.356-31.864-28.039-37.535l-21.817-5.275c-8.062-2.061-11.636-6.027-10.621-11.79,1.345-7.623,12.187-13.826,24.168-13.826,7.492,0,13.534,2.282,17.01,6.425a13.173,13.173,0,0,1,2.875,10.934l-.255,1.446h24.111l.179-1.018c1.717-9.741-.431-18.794-6.053-25.494-7.082-8.44-19.069-12.9-34.666-12.9" transform="translate(144.45 10.53)"></path><path d="M1128.749,548.468h-96.194l-3.808,21.6h36.124L1047.885,666.4h23.944l16.985-96.331h36.125Z" transform="translate(192.649 11.861)"></path><path d="M1160.96,557.707c-5.932-6.566-14.99-9.917-24.848-9.2-24.888,1.854-43.633,23.216-52.784,60.158-5.169,21.394-3.379,39.064,5.037,49.756,5.824,7.4,14.55,11.147,25.938,11.147,22.4,0,42.516-18.237,46.781-42.421,1.886-10.7-.144-20.249-5.715-26.888-5.5-6.557-14.161-10.025-25.041-10.025-6.33,0-14.816,2.857-20.061,6.464,4.849-18.165,15.023-27.125,22.863-27.757,3.18-.243,5.617.417,7.258,1.979,1.943,1.851,2.863,4.978,2.73,9.293l-.038,1.269h23.746l.179-1.018c1.529-8.671-.619-16.754-6.045-22.762m-24.007,70.5c-2.529,14.338-12.338,20.755-20.936,20.755a11.542,11.542,0,0,1-9.123-4.175c-3.1-3.7-4.322-9.488-3.264-15.492,1.856-10.516,10.61-18.445,20.364-18.445,4.394,0,7.95,1.469,10.284,4.253,2.657,3.163,3.606,7.817,2.675,13.1" transform="translate(230.791 11.821)"></path><path d="M854.595,532.4a86.9,86.9,0,1,0,86.9,86.9A86.9,86.9,0,0,0,854.595,532.4Zm4.48,133.309a43.238,43.238,0,0,1-22.375-6.2l-1.071,6.071H806.663l16.346-92.691h28.965l-1.185,6.721a43.449,43.449,0,1,1,8.287,86.1Z"></path></g></svg></a></h1>
              </div>
            </div>
            <div class="l-header__nav">
              <nav class="c-header-nav">
                <ul class="c-header-nav__list">
                  <li class="c-header-nav__item"><a class="c-header-nav__link" href="https://www.pist6.com/news"><span class="c-header-nav__txt">ニュース</span></a></li>
                  <li class="c-header-nav__item"><a class="c-header-nav__link" href="https://www.pist6.com/league/player"><span class="c-header-nav__txt">リーグ / レース</span></a></li>
                  <li class="c-header-nav__item"><a class="c-header-nav__link" href="https://www.pist6.com/player"><span class="c-header-nav__txt">プレイヤー</span></a></li>
                  <li class="c-header-nav__item"><a class="c-header-nav__link" href="https://www.pist6.com/ticket"><span class="c-header-nav__txt">チケット</span></a></li>
                  <li class="c-header-nav__item"><a class="c-header-nav__link" href="https://www.pist6.com/guide"><span class="c-header-nav__txt">ガイド</span></a></li>
                  <li class="c-header-nav__item"><a class="c-header-nav__link" href="https://www.pist6.com/access"><span class="c-header-nav__txt">ドーム</span></a></li>
                  <li class="c-header-nav__item"><a class="c-header-nav__link" href="https://tipstar.com/"><span class="c-header-nav__txt">ベッティング</span></a></li>
                </ul>
              </nav>
            </div>
            <div class="l-header__user">
              <ul class="c-header-user">
                <li class="c-header-user__item"><a class="c-header-user__link" target="_blank" href="/signin"><span class="c-header-user__icon _rock" aria-hidden="true">
                      <svg class="icon icon-rock" id="icon-rock" viewBox="0 0 18 23.5" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" area-hidden="true">
                        <path d="M2099,160h2v12h-18V160c0,0.009,1.99.013,2,0-0.05-5.037-.03-8.056,2-10,1.98-1.982,7.96-2.006,10,0C2099,151.982,2099.01,155.05,2099,160Zm-11,0h8v-7a4.615,4.615,0,0,0-4-2,4.749,4.749,0,0,0-4,2C2088,153.044,2088.02,159.992,2088,160Zm2,4a2.218,2.218,0,0,0,1,2c0.02,0.009.04,2.017,0,2-0.02-.008-1,0.028-1,0,0.01-.044.02,0.966,0,1h4v-1h-1v-2a2.025,2.025,0,0,0,1-2,2.237,2.237,0,0,0-2-2A2.188,2.188,0,0,0,2090,164Z" transform="translate(-2083 -148.5)"></path>
                      </svg></span><span class="c-header-user__txt">マイページ</span></a></li>
                <li class="c-header-user__item"><a class="c-header-user__link" target="_blank" href="/signin?register=true"><span class="c-header-user__icon _login" aria-hidden="true">
                      <svg class="icon icon-login" id="icon-login" viewBox="0 0 12 12" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" area-hidden="true">
                        <path d="M0,11.609A.393.393,0,0,0,.394,12H11.409a.392.392,0,0,0,.394-.391.386.386,0,0,0-.006-.066,5.879,5.879,0,0,0-4.136-5.53,3.283,3.283,0,1,0-3.525,0A5.878,5.878,0,0,0,0,11.609M3.4,3.264A2.5,2.5,0,1,1,5.9,5.745,2.491,2.491,0,0,1,3.4,3.264M5.9,6.527a5.106,5.106,0,0,1,5.1,4.69H.8a5.106,5.106,0,0,1,5.1-4.69"></path>
                      </svg></span><span class="c-header-user__txt">会員登録</span></a></li>
              </ul>
            </div>
            <div class="l-header__menu">
              <button class="c-header-hamburger"><span class="c-header-hamburger__line"><span class="u-visually-hidden">menu</span></span></button>
            </div>
          </div>
        </div>
      </header>
    <div class="l-content">
      <div class="l-signup-flow">
        <section class="l-regist _signup-input">
          <div class="l-regist__inner">
            <header class="l-regist__header">
              <div class="rg-header">
                <div class="rg-header__inner">
                  <h2 class="rg-header__ttl"><span class="rg-header__ttl-purpose">{{ $title }}</span></h2>
                  <p class="fs16 rg-header__lead">{{ $body }}</p>
                </div>
              </div>
            </header>
          </div>
        </section>
      </div>
    </div>
    <div class="l-pagetop" id="pagetop">
      <div class="l-pagetop__inner"><a class="c-pagetop js-pagetop" href="#top"><span class="c-pagetop__arrow" aria-hidden="true">
            <svg class="c-pagetop__arrow-entity" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 14 28">
              <path fill-rule="evenodd" d="M9.000,12.632 L9.000,28.000 L5.000,28.000 L5.000,12.632 L0.294,12.632 L7.081,0.876 L13.868,12.632 L9.000,12.632 Z"></path>
            </svg></span><span class="c-pagetop__txt">Page Top</span></a></div>
    </div>
    <div class="l-sns">
      <div class="l-sns__inner">
        <ul class="c-sns">
          <li class="c-sns__item"><a class="c-sns__link" href="https://twitter.com/pist6_official/" target="_blank" rel="noreferrer"><span class="c-sns__icon _twitter" aria-hidden="true">
                <svg class="icon icon-twitter" id="icon-twitter" viewBox="0 0 38 31" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" area-hidden="true">
                  <path fill-rule="evenodd" d="M12.026,30.734 C26.086,30.734 33.775,19.096 33.775,9.004 C33.775,8.673 33.769,8.344 33.754,8.016 C35.246,6.938 36.543,5.593 37.567,4.062 C36.197,4.670 34.723,5.080 33.177,5.264 C34.755,4.319 35.967,2.823 36.538,1.039 C35.061,1.914 33.426,2.551 31.685,2.893 C30.290,1.409 28.303,0.480 26.105,0.480 C21.883,0.480 18.460,3.901 18.460,8.117 C18.460,8.717 18.527,9.299 18.658,9.859 C12.305,9.540 6.672,6.500 2.902,1.879 C2.245,3.007 1.867,4.319 1.867,5.718 C1.867,8.367 3.216,10.706 5.268,12.075 C4.014,12.036 2.836,11.692 1.806,11.120 C1.805,11.151 1.805,11.183 1.805,11.217 C1.805,14.916 4.440,18.004 7.937,18.705 C7.295,18.879 6.619,18.973 5.922,18.973 C5.430,18.973 4.951,18.924 4.485,18.835 C5.458,21.870 8.280,24.078 11.626,24.140 C9.009,26.189 5.714,27.409 2.132,27.409 C1.515,27.409 0.907,27.374 0.309,27.303 C3.692,29.470 7.709,30.734 12.026,30.734 "></path>
                </svg></span><span class="c-sns__txt" aria-hidden="true">Twitter</span></a></li>
          <li class="c-sns__item"><a class="c-sns__link" href="https://www.instagram.com/pist6_official/" target="_blank" rel="noreferrer"><span class="c-sns__icon _instagram" aria-hidden="true">
                <svg class="icon icon-instagram" id="icon-instagram" viewBox="0 0 23 23" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" area-hidden="true">
                  <path fill-rule="evenodd" d="M22.354,15.917 C22.300,17.104 22.111,17.915 21.836,18.624 C21.551,19.358 21.169,19.980 20.549,20.600 C19.929,21.220 19.307,21.601 18.574,21.886 C17.864,22.162 17.53,22.351 15.866,22.405 C14.676,22.459 14.297,22.472 11.268,22.472 C8.238,22.472 7.858,22.459 6.669,22.405 C5.482,22.351 4.671,22.162 3.961,21.886 C3.228,21.601 2.606,21.220 1.986,20.600 C1.366,19.980 0.984,19.358 0.699,18.624 C0.423,17.915 0.235,17.104 0.181,15.917 C0.126,14.727 0.114,14.347 0.114,11.318 C0.114,8.289 0.126,7.909 0.181,6.719 C0.235,5.532 0.423,4.721 0.699,4.12 C0.984,3.278 1.366,2.656 1.986,2.36 C2.606,1.416 3.228,1.35 3.961,0.750 C4.671,0.474 5.482,0.286 6.669,0.231 C7.858,0.177 8.238,0.164 11.268,0.164 C14.297,0.164 14.676,0.177 15.866,0.231 C17.53,0.286 17.864,0.474 18.574,0.750 C19.307,1.35 19.929,1.416 20.549,2.36 C21.169,2.656 21.551,3.278 21.836,4.12 C22.111,4.721 22.300,5.532 22.354,6.719 C22.409,7.909 22.421,8.289 22.421,11.318 C22.421,14.347 22.409,14.727 22.354,15.917 ZM20.347,6.811 C20.297,5.724 20.115,5.133 19.963,4.740 C19.760,4.219 19.519,3.848 19.128,3.457 C18.738,3.67 18.366,2.825 17.846,2.623 C17.453,2.470 16.862,2.289 15.775,2.239 C14.598,2.185 14.246,2.174 11.268,2.174 C8.289,2.174 7.937,2.185 6.760,2.239 C5.673,2.289 5.82,2.470 4.689,2.623 C4.169,2.825 3.797,3.67 3.407,3.457 C3.16,3.848 2.775,4.219 2.572,4.740 C2.420,5.133 2.238,5.724 2.188,6.811 C2.135,7.987 2.123,8.340 2.123,11.318 C2.123,14.296 2.135,14.649 2.188,15.825 C2.238,16.913 2.420,17.503 2.572,17.896 C2.775,18.417 3.16,18.789 3.407,19.179 C3.797,19.569 4.169,19.811 4.689,20.13 C5.82,20.166 5.673,20.348 6.760,20.397 C7.936,20.451 8.289,20.462 11.268,20.462 C14.246,20.462 14.599,20.451 15.775,20.397 C16.862,20.348 17.453,20.166 17.846,20.13 C18.366,19.811 18.738,19.569 19.128,19.179 C19.519,18.789 19.760,18.417 19.963,17.896 C20.115,17.503 20.297,16.913 20.347,15.825 C20.400,14.649 20.412,14.296 20.412,11.318 C20.412,8.340 20.400,7.987 20.347,6.811 ZM17.221,6.703 C16.482,6.703 15.883,6.103 15.883,5.364 C15.883,4.625 16.482,4.26 17.221,4.26 C17.961,4.26 18.560,4.625 18.560,5.364 C18.560,6.103 17.961,6.703 17.221,6.703 ZM11.268,17.46 C8.104,17.46 5.540,14.481 5.540,11.318 C5.540,8.155 8.104,5.590 11.268,5.590 C14.431,5.590 16.995,8.155 16.995,11.318 C16.995,14.481 14.431,17.46 11.268,17.46 ZM11.268,7.600 C9.214,7.600 7.550,9.265 7.550,11.318 C7.550,13.372 9.214,15.36 11.268,15.36 C13.321,15.36 14.985,13.372 14.985,11.318 C14.985,9.265 13.321,7.600 11.268,7.600 Z"></path>
                </svg></span><span class="c-sns__txt" aria-hidden="true">Instagram</span></a></li>
          <li class="c-sns__item"><a class="c-sns__link" href="https://www.youtube.com/channel/UC7ZGw184pJdsFCXfsXXXO-A" target="_blank" rel="noreferrer"><span class="c-sns__icon _youtube" aria-hidden="true">
                <svg class="icon icon-youtube" id="icon-youtube" viewBox="0 0 28 20" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" area-hidden="true">
                  <path fill-rule="evenodd" d="M22.510,0.511 L4.754,0.511 C2.246,0.511 0.212,2.584 0.212,5.142 L0.212,14.826 C0.212,17.384 2.246,19.457 4.754,19.457 L22.510,19.457 C25.19,19.457 27.52,17.384 27.52,14.826 L27.52,5.142 C27.52,2.584 25.19,0.511 22.510,0.511 ZM18.889,10.169 L10.837,14.380 C10.735,14.433 10.611,14.393 10.558,14.289 C10.543,14.260 10.535,14.227 10.535,14.194 L10.535,5.774 C10.536,5.658 10.629,5.564 10.743,5.565 C10.776,5.565 10.808,5.573 10.837,5.589 L18.889,9.799 C18.990,9.852 19.30,9.979 18.978,10.82 C18.959,10.121 18.927,10.153 18.889,10.174 L18.889,10.169 Z"></path>
                </svg></span><span class="c-sns__txt" aria-hidden="true">
                 YouTube</span></a></li>
        </ul>
      </div>
    </div>
    <footer class="l-footer">
        <div class="l-footer__inner">
          <div class="l-footer__container _top">
            <div class="l-footer__business">
              <div class="l-footer__logo">
                <p class="c-footer-logo">
                  <svg class="c-footer-logo__entity" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 630.58 173.797">
                    <g transform="translate(-767.696 -532.396)">
                      <path d="M976.394,560c-6.239-7.435-16.432-11.53-28.7-11.53H900.634L879.839,666.4h23.942l7.814-43.382h23.383c25.058,0,43.166-14.423,47.259-37.638,1.755-9.957-.264-18.732-5.843-25.381m-55.283,9.079H944.49c4.952,0,8.817,1.486,11.177,4.3,2.475,2.948,3.3,7.237,2.39,12.4-1.632,9.263-10.563,16.8-19.907,16.8H915.205Z" transform="translate(82.759 11.861)" fill="#fff"></path>
                      <path d="M937.481,666.4h24.111l20.795-117.93H958.275Z" transform="translate(125.297 11.861)" fill="#fff"></path>
                      <path d="M1026.713,546.665c-26.214,0-47.775,14.373-51.267,34.174-3.358,19.039,5.329,30.726,26.546,35.721l21.8,5.271c6.33,1.691,13.577,5.395,12.162,13.424-1.557,8.106-12.663,16.146-27.9,15-7.723-.629-13.631-3.327-17.086-7.8a16.608,16.608,0,0,1-3.115-13.026l.256-1.446H964.165l-.179,1.018a34.135,34.135,0,0,0,6.961,27.682c5.127,6.245,15.179,13.774,33.946,14.177q.67.013,1.344.014c23.527,0,49.666-12.948,53.585-35.178,3.332-18.888-6.356-31.864-28.039-37.535l-21.817-5.275c-8.062-2.061-11.636-6.027-10.621-11.79,1.345-7.623,12.187-13.826,24.168-13.826,7.492,0,13.534,2.282,17.01,6.425a13.173,13.173,0,0,1,2.875,10.934l-.255,1.446h24.111l.179-1.018c1.717-9.741-.431-18.794-6.053-25.494-7.082-8.44-19.069-12.9-34.666-12.9" transform="translate(144.45 10.53)" fill="#fff"></path>
                      <path d="M1128.749,548.468h-96.194l-3.808,21.6h36.124L1047.885,666.4h23.944l16.985-96.331h36.125Z" transform="translate(192.649 11.861)" fill="#fff"></path>
                      <path d="M1160.96,557.707c-5.932-6.566-14.99-9.917-24.848-9.2-24.888,1.854-43.633,23.216-52.784,60.158-5.169,21.394-3.379,39.064,5.037,49.756,5.824,7.4,14.55,11.147,25.938,11.147,22.4,0,42.516-18.237,46.781-42.421,1.886-10.7-.144-20.249-5.715-26.888-5.5-6.557-14.161-10.025-25.041-10.025-6.33,0-14.816,2.857-20.061,6.464,4.849-18.165,15.023-27.125,22.863-27.757,3.18-.243,5.617.417,7.258,1.979,1.943,1.851,2.863,4.978,2.73,9.293l-.038,1.269h23.746l.179-1.018c1.529-8.671-.619-16.754-6.045-22.762m-24.007,70.5c-2.529,14.338-12.338,20.755-20.936,20.755a11.542,11.542,0,0,1-9.123-4.175c-3.1-3.7-4.322-9.488-3.264-15.492,1.856-10.516,10.61-18.445,20.364-18.445,4.394,0,7.95,1.469,10.284,4.253,2.657,3.163,3.606,7.817,2.675,13.1" transform="translate(230.791 11.821)" fill="#fff"></path>
                      <path d="M854.595,532.4a86.9,86.9,0,1,0,86.9,86.9A86.9,86.9,0,0,0,854.595,532.4Zm4.48,133.309a43.238,43.238,0,0,1-22.375-6.2l-1.071,6.071H806.663l16.346-92.691h28.965l-1.185,6.721a43.449,43.449,0,1,1,8.287,86.1Z" fill="#fff"></path>
                    </g>
                  </svg>
                </p>
              </div>
              <div class="l-footer__info">
                <div class="c-footer-info">
                  <p class="c-footer-info__address">〒261-0022 千葉県千葉市美浜区美浜１</p><a class="c-footer-info__gmap" href=""><span class="c-footer-info__gmap-txt">Google Map</span></a>
                </div>
              </div>
            </div>
            <div class="l-footer__page">
              <nav class="c-footer-page">
                <ul class="c-footer-page__list">
                  <li class="c-footer-page__list-item"><a class="c-footer-page__link" href="https://www.pist6.com/news"><span class="c-footer-page__link-txt">ニュース</span></a></li>
                  <li class="c-footer-page__list-item"><a class="c-footer-page__link" href="https://www.pist6.com/league/player"><span class="c-footer-page__link-txt">リーグ / レース</span></a></li>
                  <li class="c-footer-page__list-item"><a class="c-footer-page__link" href="https://www.pist6.com/player"><span class="c-footer-page__link-txt">プレイヤー</span></a></li>
                </ul>
                <ul class="c-footer-page__list">
                  <li class="c-footer-page__list-item"><a class="c-footer-page__link" href="https://www.pist6.com/ticket"><span class="c-footer-page__link-txt">チケット</span></a></li>
                  <li class="c-footer-page__list-item"><a class="c-footer-page__link" href="https://www.pist6.com/guide"><span class="c-footer-page__link-txt">ガイド</span></a></li>
                  <li class="c-footer-page__list-item"><a class="c-footer-page__link" href="https://www.pist6.com/access"><span class="c-footer-page__link-txt">アクセス</span></a></li>
                </ul>
              </nav>
            </div>
            <div class="l-footer__user">
              <ul class="c-footer-user">
                <li class="c-footer-user__item"><a class="c-footer-user__link _border" href="/mypage" target="_blank" rel="noreferrer"><span class="c-footer-user__icon _login" aria-hidden="true">
                      <svg class="icon icon-rock" id="icon-rock" viewBox="0 0 18 23.5" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" area-hidden="true">
                        <path d="M2099,160h2v12h-18V160c0,0.009,1.99.013,2,0-0.05-5.037-.03-8.056,2-10,1.98-1.982,7.96-2.006,10,0C2099,151.982,2099.01,155.05,2099,160Zm-11,0h8v-7a4.615,4.615,0,0,0-4-2,4.749,4.749,0,0,0-4,2C2088,153.044,2088.02,159.992,2088,160Zm2,4a2.218,2.218,0,0,0,1,2c0.02,0.009.04,2.017,0,2-0.02-.008-1,0.028-1,0,0.01-.044.02,0.966,0,1h4v-1h-1v-2a2.025,2.025,0,0,0,1-2,2.237,2.237,0,0,0-2-2A2.188,2.188,0,0,0,2090,164Z" transform="translate(-2083 -148.5)"></path>
                      </svg></span><span class="c-footer-user__txt">マイページ</span></a></li>
              </ul>
            </div>
          </div>
          <div class="l-footer__container _bottom">
            <div class="l-footer__util">
              <div class="l-footer__util-ticket">
                <div class="c-footer-util">
                  <p class="c-footer-util__ttl"><span class="c-footer-util__ttl-txt">・チケット販売と関連する事項</span></p>
                  <nav class="c-footer-util__nav">
                    <ul class="c-footer-util__list">
                      <li class="c-footer-util__list-item"><a class="c-footer-util__link" href="https://www.pist6.com/guide/facility-guide/manner/"><span class="c-footer-util__link-txt">チケット購入の際の注意事項</span></a></li>
                      <li class="c-footer-util__list-item"><a class="c-footer-util__link" href="https://www.pist6.com/guide/service-guide/terms/"><span class="c-footer-util__link-txt">利用規約</span></a></li>
                      <li class="c-footer-util__list-item"><a class="c-footer-util__link" target="_blank" href=""><span class="c-footer-util__link-txt">プライバシーポリシー</span></a></li>
                      <li class="c-footer-util__list-item"><a class="c-footer-util__link" href="https://www.pist6.com/guide/service-guide/transaction/"><span class="c-footer-util__link-txt">特定商取引法に基づく表示</span></a></li>
                    </ul>
                  </nav>
                  <p class="c-footer-util__note"><span class="c-footer-util__note-txt">入場チケットは、千葉市より委託された株式会社JPFが販売しています。</span></p>
                </div>
              </div>
              <div class="l-footer__util-pist6">
                <div class="c-footer-util">
                  <p class="c-footer-util__ttl"><span class="c-footer-util__ttl-txt">・PIST6オフィシャルサイト</span></p>
                  <nav class="c-footer-util__nav">
                    <ul class="c-footer-util__list">
                      <li class="c-footer-util__list-item"><a class="c-footer-util__link" href="https://www.pist6.com/guide/service-guide/faq/"><span class="c-footer-util__link-txt">FAQ</span></a></li>
                      <li class="c-footer-util__list-item"><a class="c-footer-util__link" href="https://www.pist6.com/contact/"><span class="c-footer-util__link-txt">一般問い合わせ</span></a></li>
                      <li class="c-footer-util__list-item"><a class="c-footer-util__link" href="https://www.pist6.com/contact/corporation/"><span class="c-footer-util__link-txt">法人・メディア問い合わせ</span></a></li>
                      <li class="c-footer-util__list-item"><a class="c-footer-util__link" target="_blank" href="https://pist6.co.jp/company/privacy.html"><span class="c-footer-util__link-txt">プライバシーポリシー</span></a></li>
                    </ul>
                  </nav>
                </div>
              </div>
            </div>
            <div class="l-footer__manage">
              <div class="c-footer-manage">
                <p class="c-footer-manage__note">「PIST6」は千葉市が行う250競走の呼称です。</p>
              </div>
            </div>
            <div class="l-footer__copy">
              <p class="c-footer-copy">© PIST6 Inc.</p>
            </div>
          </div>
        </div>
      </footer>
    </body>
    </html>
