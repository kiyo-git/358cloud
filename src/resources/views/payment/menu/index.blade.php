@extends('payment.app')
@section('title', 'PIST6 お支払い方法のご確認')
@section('content')
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="display:none;">
    <symbol id="icon-login" viewBox="0 0 12 12">
      <path d="M0,11.609A.393.393,0,0,0,.394,12H11.409a.392.392,0,0,0,.394-.391.386.386,0,0,0-.006-.066,5.879,5.879,0,0,0-4.136-5.53,3.283,3.283,0,1,0-3.525,0A5.878,5.878,0,0,0,0,11.609M3.4,3.264A2.5,2.5,0,1,1,5.9,5.745,2.491,2.491,0,0,1,3.4,3.264M5.9,6.527a5.106,5.106,0,0,1,5.1,4.69H.8a5.106,5.106,0,0,1,5.1-4.69"></path>
    </symbol>
    <symbol id="icon-search" viewBox="0 0 12 12">
      <path d="M7.986,7.453a4.535,4.535,0,1,0-.533.533l3.987,3.991.533-.533Zm-3.458.854A3.779,3.779,0,1,1,8.307,4.528,3.779,3.779,0,0,1,4.528,8.307Z"></path>
    </symbol>
    <symbol id="icon-seat" viewBox="0 0 9 12">
      <path d="M27.028,11.365h-.5V6.283A1.034,1.034,0,0,0,25.5,5.251H21.679a1.034,1.034,0,0,0-1.032,1.032v5.082h-.5a.651.651,0,0,0-.65.65v1.528a.651.651,0,0,0,.65.65h1.185l-.681,2.724a.268.268,0,1,0,.52.13l.713-2.854h3.4L26,17.048a.268.268,0,0,0,.26.2.265.265,0,0,0,.065-.008.268.268,0,0,0,.2-.325l-.681-2.724h1.185a.651.651,0,0,0,.65-.65V12.015A.651.651,0,0,0,27.028,11.365ZM21.183,6.283a.5.5,0,0,1,.5-.5H25.5a.5.5,0,0,1,.5.5v5.082H21.183Zm5.96,7.26a.114.114,0,0,1-.114.114H20.15a.114.114,0,0,1-.114-.114V12.015a.114.114,0,0,1,.114-.114h6.878a.114.114,0,0,1,.114.114v1.529Z" transform="translate(-19.5 -5.251)"></path>
    </symbol>
    <symbol id="icon-external" viewBox="0 0 16.938 16.639">
      <path d="M2123.722,15612.529v9.406H2107.97v-15.477h9.511v2.057h-7.436v11.395h11.6v-7.381Zm-5.055-7.232v2.063h2.676l-5.442,5.424a1.052,1.052,0,0,0,0,1.484h0a1.086,1.086,0,0,0,1.493,0l5.439-5.424v2.568h2.076v-6.115Zm4.166,2.063Z" transform="translate(-2107.97 -15605.297)" fill-rule="evenodd"></path>
    </symbol>
    <symbol id="icon-clock" viewBox="0 0 13.972 13.972">
      <path d="M24.986,970.362a6.986,6.986,0,1,0,6.986,6.986A7,7,0,0,0,24.986,970.362Zm0,1.31a5.676,5.676,0,1,1-5.676,5.676A5.666,5.666,0,0,1,24.986,971.672Zm0,1.31a.655.655,0,0,0-.655.655v3.711a.655.655,0,0,0,.655.655H28.26a.655.655,0,0,0,0-1.31h-2.62v-3.056A.655.655,0,0,0,24.986,972.982Z" transform="translate(-18 -970.362)"></path>
    </symbol>
    <symbol id="icon-twitter" viewBox="0 0 38 31">
      <path fill-rule="evenodd" d="M12.026,30.734 C26.086,30.734 33.775,19.096 33.775,9.004 C33.775,8.673 33.769,8.344 33.754,8.016 C35.246,6.938 36.543,5.593 37.567,4.062 C36.197,4.670 34.723,5.080 33.177,5.264 C34.755,4.319 35.967,2.823 36.538,1.039 C35.061,1.914 33.426,2.551 31.685,2.893 C30.290,1.409 28.303,0.480 26.105,0.480 C21.883,0.480 18.460,3.901 18.460,8.117 C18.460,8.717 18.527,9.299 18.658,9.859 C12.305,9.540 6.672,6.500 2.902,1.879 C2.245,3.007 1.867,4.319 1.867,5.718 C1.867,8.367 3.216,10.706 5.268,12.075 C4.014,12.036 2.836,11.692 1.806,11.120 C1.805,11.151 1.805,11.183 1.805,11.217 C1.805,14.916 4.440,18.004 7.937,18.705 C7.295,18.879 6.619,18.973 5.922,18.973 C5.430,18.973 4.951,18.924 4.485,18.835 C5.458,21.870 8.280,24.078 11.626,24.140 C9.009,26.189 5.714,27.409 2.132,27.409 C1.515,27.409 0.907,27.374 0.309,27.303 C3.692,29.470 7.709,30.734 12.026,30.734"> </path>
    </symbol>
    <symbol id="icon-instagram" viewBox="0 0 23 23">
      <path fill-rule="evenodd" d="M22.354,15.917 C22.300,17.104 22.111,17.915 21.836,18.624 C21.551,19.358 21.169,19.980 20.549,20.600 C19.929,21.220 19.307,21.601 18.574,21.886 C17.864,22.162 17.53,22.351 15.866,22.405 C14.676,22.459 14.297,22.472 11.268,22.472 C8.238,22.472 7.858,22.459 6.669,22.405 C5.482,22.351 4.671,22.162 3.961,21.886 C3.228,21.601 2.606,21.220 1.986,20.600 C1.366,19.980 0.984,19.358 0.699,18.624 C0.423,17.915 0.235,17.104 0.181,15.917 C0.126,14.727 0.114,14.347 0.114,11.318 C0.114,8.289 0.126,7.909 0.181,6.719 C0.235,5.532 0.423,4.721 0.699,4.12 C0.984,3.278 1.366,2.656 1.986,2.36 C2.606,1.416 3.228,1.35 3.961,0.750 C4.671,0.474 5.482,0.286 6.669,0.231 C7.858,0.177 8.238,0.164 11.268,0.164 C14.297,0.164 14.676,0.177 15.866,0.231 C17.53,0.286 17.864,0.474 18.574,0.750 C19.307,1.35 19.929,1.416 20.549,2.36 C21.169,2.656 21.551,3.278 21.836,4.12 C22.111,4.721 22.300,5.532 22.354,6.719 C22.409,7.909 22.421,8.289 22.421,11.318 C22.421,14.347 22.409,14.727 22.354,15.917 ZM20.347,6.811 C20.297,5.724 20.115,5.133 19.963,4.740 C19.760,4.219 19.519,3.848 19.128,3.457 C18.738,3.67 18.366,2.825 17.846,2.623 C17.453,2.470 16.862,2.289 15.775,2.239 C14.598,2.185 14.246,2.174 11.268,2.174 C8.289,2.174 7.937,2.185 6.760,2.239 C5.673,2.289 5.82,2.470 4.689,2.623 C4.169,2.825 3.797,3.67 3.407,3.457 C3.16,3.848 2.775,4.219 2.572,4.740 C2.420,5.133 2.238,5.724 2.188,6.811 C2.135,7.987 2.123,8.340 2.123,11.318 C2.123,14.296 2.135,14.649 2.188,15.825 C2.238,16.913 2.420,17.503 2.572,17.896 C2.775,18.417 3.16,18.789 3.407,19.179 C3.797,19.569 4.169,19.811 4.689,20.13 C5.82,20.166 5.673,20.348 6.760,20.397 C7.936,20.451 8.289,20.462 11.268,20.462 C14.246,20.462 14.599,20.451 15.775,20.397 C16.862,20.348 17.453,20.166 17.846,20.13 C18.366,19.811 18.738,19.569 19.128,19.179 C19.519,18.789 19.760,18.417 19.963,17.896 C20.115,17.503 20.297,16.913 20.347,15.825 C20.400,14.649 20.412,14.296 20.412,11.318 C20.412,8.340 20.400,7.987 20.347,6.811 ZM17.221,6.703 C16.482,6.703 15.883,6.103 15.883,5.364 C15.883,4.625 16.482,4.26 17.221,4.26 C17.961,4.26 18.560,4.625 18.560,5.364 C18.560,6.103 17.961,6.703 17.221,6.703 ZM11.268,17.46 C8.104,17.46 5.540,14.481 5.540,11.318 C5.540,8.155 8.104,5.590 11.268,5.590 C14.431,5.590 16.995,8.155 16.995,11.318 C16.995,14.481 14.431,17.46 11.268,17.46 ZM11.268,7.600 C9.214,7.600 7.550,9.265 7.550,11.318 C7.550,13.372 9.214,15.36 11.268,15.36 C13.321,15.36 14.985,13.372 14.985,11.318 C14.985,9.265 13.321,7.600 11.268,7.600 Z"></path>
    </symbol>
    <symbol id="icon-facebook" viewBox="0 0 23 23">
      <path fill-rule="evenodd" d="M11.664,0.812 C5.574,0.812 0.636,5.777 0.636,11.901 C0.636,17.437 4.669,22.24 9.941,22.856 L9.941,15.107 L7.141,15.107 L7.141,11.901 L9.941,11.901 L9.941,9.458 C9.941,6.679 11.588,5.144 14.107,5.144 C15.313,5.144 16.576,5.360 16.576,5.360 L16.576,8.90 L15.185,8.90 C13.815,8.90 13.388,8.944 13.388,9.821 L13.388,11.901 L16.446,11.901 L15.957,15.107 L13.388,15.107 L13.388,22.856 C18.660,22.24 22.693,17.437 22.693,11.901 C22.693,5.777 17.755,0.812 11.664,0.812 Z"></path>
    </symbol>
    <symbol id="icon-youtube" viewBox="0 0 28 20">
      <path fill-rule="evenodd" d="M22.510,0.511 L4.754,0.511 C2.246,0.511 0.212,2.584 0.212,5.142 L0.212,14.826 C0.212,17.384 2.246,19.457 4.754,19.457 L22.510,19.457 C25.19,19.457 27.52,17.384 27.52,14.826 L27.52,5.142 C27.52,2.584 25.19,0.511 22.510,0.511 ZM18.889,10.169 L10.837,14.380 C10.735,14.433 10.611,14.393 10.558,14.289 C10.543,14.260 10.535,14.227 10.535,14.194 L10.535,5.774 C10.536,5.658 10.629,5.564 10.743,5.565 C10.776,5.565 10.808,5.573 10.837,5.589 L18.889,9.799 C18.990,9.852 19.30,9.979 18.978,10.82 C18.959,10.121 18.927,10.153 18.889,10.174 L18.889,10.169 Z"></path>
    </symbol>
    <symbol id="icon-pdf" viewBox="0 0 18 14">
      <path d="M1965,539.5h-14V542h1.5v-1h11v7h-1v1.5h2.5Z" transform="translate(-1947 -539.5)"></path>
      <path d="M1948.5,545v7h11v-7h-11m-1.5-1.5h14v10h-14Z" transform="translate(-1947 -539.5)"></path>
    </symbol>
    <symbol id="icon-rock" viewBox="0 0 18 23.5">
      <path d="M2099,160h2v12h-18V160c0,0.009,1.99.013,2,0-0.05-5.037-.03-8.056,2-10,1.98-1.982,7.96-2.006,10,0C2099,151.982,2099.01,155.05,2099,160Zm-11,0h8v-7a4.615,4.615,0,0,0-4-2,4.749,4.749,0,0,0-4,2C2088,153.044,2088.02,159.992,2088,160Zm2,4a2.218,2.218,0,0,0,1,2c0.02,0.009.04,2.017,0,2-0.02-.008-1,0.028-1,0,0.01-.044.02,0.966,0,1h4v-1h-1v-2a2.025,2.025,0,0,0,1-2,2.237,2.237,0,0,0-2-2A2.188,2.188,0,0,0,2090,164Z" transform="translate(-2083 -148.5)"></path>
    </symbol>
  </svg>
  <div class="l-content">
    <div class="l-signup-flow">
      <div class="rg-flow flow2">
        <div class="rg-flow__inner">
          <ul class="ti-flow__list">
            <li class="rg-flow__item">
              <div class="ti-flow__num u-disp-sp _step01">
                <div class="ti-flow__num-inner">
                  <p class="ti-flow__num-txt"><span class="ti-flow__num-current">1<span class="ti-flow__num-total">/ 7</span></span></p>
                </div>
                <div class="ti-flow__num-circle" aria-hidden="true"></div>
              </div>
              <p class="rg-flow__step"><span class="rg-flow__step-num">STEP1:<span class="rg-flow__step-status">開催日程選択</span></span></p>
            </li>
            <li class="rg-flow__item">
              <div class="ti-flow__num u-disp-sp _step02">
                <div class="ti-flow__num-inner">
                  <p class="ti-flow__num-txt"><span class="ti-flow__num-current">2<span class="ti-flow__num-total">/ 7</span></span></p>
                </div>
                <div class="ti-flow__num-circle" aria-hidden="true"></div>
              </div>
              <p class="rg-flow__step"><span class="rg-flow__step-num">STEP2:<span class="rg-flow__step-status">エリア選択</span></span></p>
            </li>
            <li class="rg-flow__item">
              <div class="ti-flow__num u-disp-sp _step03">
                <div class="ti-flow__num-inner">
                  <p class="ti-flow__num-txt"><span class="ti-flow__num-current">3<span class="ti-flow__num-total">/ 7</span></span></p>
                </div>
                <div class="ti-flow__num-circle" aria-hidden="true"></div>
              </div>
              <p class="rg-flow__step"><span class="rg-flow__step-num">STEP3:<span class="rg-flow__step-status">座席タイプ/数量選択</span></span></p>
            </li>
            <li class="rg-flow__item">
              <div class="ti-flow__num u-disp-sp _step04">
                <div class="ti-flow__num-inner">
                  <p class="ti-flow__num-txt"><span class="ti-flow__num-current">4<span class="ti-flow__num-total">/ 7</span></span></p>
                </div>
                <div class="ti-flow__num-circle" aria-hidden="true"></div>
              </div>
              <p class="rg-flow__step"><span class="rg-flow__step-num">STEP4:<span class="rg-flow__step-status">オプション追加</span></span></p>
            </li>
            <li class="rg-flow__item">
              <div class="ti-flow__num u-disp-sp _step05">
                <div class="ti-flow__num-inner">
                  <p class="ti-flow__num-txt"><span class="ti-flow__num-current">5<span class="ti-flow__num-total">/ 7</span></span></p>
                </div>
                <div class="ti-flow__num-circle" aria-hidden="true"></div>
              </div>
              <p class="rg-flow__step"><span class="rg-flow__step-num">STEP5:<span class="rg-flow__step-status">選択内容のご確認</span></span></p>
            </li>
            <li class="rg-flow__item is-current">
              <div class="ti-flow__num u-disp-sp _step06">
                <div class="ti-flow__num-inner">
                  <p class="ti-flow__num-txt"><span class="ti-flow__num-current">6<span class="ti-flow__num-total">/ 7</span></span></p>
                </div>
                <div class="ti-flow__num-circle" aria-hidden="true"></div>
              </div>
              <p class="rg-flow__step is-current"><span class="rg-flow__step-num">STEP6:<span class="rg-flow__step-status">お支払い方法のご確認</span></span></p>
            </li>
            <li class="rg-flow__item">
              <div class="ti-flow__num u-disp-sp _step07">
                <div class="ti-flow__num-inner">
                  <p class="ti-flow__num-txt"><span class="ti-flow__num-current">7<span class="ti-flow__num-total">/ 7</span></span></p>
                </div>
                <div class="ti-flow__num-circle" aria-hidden="true"></div>
              </div>
              <p class="rg-flow__step"><span class="rg-flow__step-num">STEP7:<span class="rg-flow__step-status">購入手続き完了</span></span></p>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <section class="l-ticket">
      <div class="l-ticket__inner">
        <header class="l-ticket__header">
          <div class="ti-header">
            <div class="ti-header__inner">
              <h2 class="ti-header__ttl"><span class="ti-header__ttl-purpose">お支払い方法のご確認</span></h2>
              <p class="ti-header__lead">内容をご確認いただき、購入手続きへ進んでください。</p>
              <div class="ti-header__race">
                <div class="c-select-frame">
                  <div class="c-select-frame__head">
                    <p class="c-select-frame__ttl">選択中の内容</p>
                  </div>
                  <div class="c-select-frame__body">
                    <div class="ti-select">
                      <div class="ti-select__date">
                        <p class="ti-select__date-detail"><span class="ti-select__date-head">日時：</span><span class="ti-select__date-txt">5.16</span><span class="ti-select__date-week">(土曜日)</span><span class="ti-select__date-zone _day">デイ</span><span class="ti-select__date-time">開場11:00　開演12:00</span></p>
                      </div>
                      <div class="ti-select__race">
                        <p class="ti-select__race-name"><span class="ti-select__race-group">20-21 オータムシーズン ラウンド1</span><span class="ti-select__race-class">予選〜準々決勝</span></p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </header>
        <div class="l-ticket__body">
          <div class="ti-body">
            <div class="ti-body__option">
              <div class="ti-option">
                <div class="ti-option__inner">
                  <div class="ti-option__select">
                    <div class="c-select-frame">
                      <div class="c-select-frame__head">
                        <p class="c-select-frame__ttl">選択中の座席</p>
                      </div>
                      <div class="c-select-frame__body _no-border">
                        <ul class="c-select-list">
                          <li class="c-select-list__item _border">
                            <div class="ti-select">
                              @foreach ($seats as $seat)
                                <div class="ti-select__seat">
                                  <div class="ti-select__seat-icon" aria-hidden="true">
                                    <svg class="icon icon-seat" viewBox="0 0 12 12" aria-hidden="true">
                                      <use xlink:href="#icon-seat"></use>
                                    </svg>
                                  </div>
                                  <p class="ti-select__seat-position">{{$seat}}</p>
                                </div>
                              @endforeach
                              <div class="ti-select__price total_price">
                                <h3 class="w-100 fs20 fw600">お支払い金額</h3>
                                <p class="ti-select__price-detail w-100"><span class="db ti-select__price-head w-50 al">小計：</span><span class="db ti-select__price-value w-50 ar">¥{{ number_format($amount) }}（税込）</span></p>
                                <p class="ti-select__price-detail w-100"><span class="db ti-select__price-head w-50 al">クーポン適用：</span><span class="db ti-select__price-value w-50 ar not">なし</span></p>
                                <p class="ti-select__price-detail w-100 last"><span class="db ti-select__price-head w-50 al">オプション：</span><span class="db ti-select__price-value w-50 ar not">なし</span></p>
                                <p class="ti-select__price-detail w-100 all"><span class="db ti-select__price-head w-50 al">合計：</span><span class="db ti-select__price-value w-50 ar">¥{{ number_format($amount) }}<br class="viewsp">（税込）</span></p>
                              </div>
                            </div>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <form action="{{route('payment.method')}}" method="POST">
                    @csrf
                    <div class="ti-option__select">
                      <div class="c-select-frame">
                        <div class="c-select-frame__head">
                          <p class="c-select-frame__ttl">お支払い方法</p>
                        </div>
                        <div class="c-select-frame__body _no-border">
                          <ul class="c-select-list">
                            <li class="c-select-list__item _border">
                              <div class="ti-select">
                                  <div class="ti-select__seat">
                                    <div class="rg-regist__inputs half">
                                      <div class="rg-regist__inputs-items">
                                        <div class="rg-regist__inputs-item">
                                          <label class="rg-regist__input-label">
                                            <div class="c-input-check">
                                              <input class="c-input-check__body" type="radio" name="method" value="credit" checked><span class="c-input-check__marker" aria-hidden="true"></span>
                                            </div><span class="rg-regist-term__input-txt">クレジットカード</span><span class="rg-regist-term__input-img">
                                              <img src="{{asset('img/payment/credit.png')}}">
                                            </span>
                                          </label>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="ti-select__seat">
                                    <div class="rg-regist__inputs half">
                                      <div class="rg-regist__inputs-items">
                                        <div class="rg-regist__inputs-item">
                                          <label class="rg-regist__input-label">
                                            <div class="c-input-check">
                                              <input class="c-input-check__body" type="radio" name="method" value="paypay"><span class="c-input-check__marker" aria-hidden="true"></span>
                                            </div><span class="rg-regist-term__input-txt">PayPay</span><span class="rg-regist-term__input-img">
                                              <img src="{{asset('img/payment/paypay.png')}}">
                                            </span>
                                          </label>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="ti-select__seat">
                                    <div class="rg-regist__inputs half">
                                      <div class="rg-regist__inputs-items">
                                        <div class="rg-regist__inputs-item">
                                          <label class="rg-regist__input-label">
                                            <div class="c-input-check">
                                              <input class="c-input-check__body" type="radio" name="method" value="netbank"><span class="c-input-check__marker" aria-hidden="true"></span>
                                            </div><span class="rg-regist-term__input-txt">ネットバンク<br><a class="fs12 cgray" href="">利用可能ネットバンク一覧</a></span><span class="rg-regist-term__input-img">
                                              <img src="{{asset('img/payment/netbank.png')}}">
                                            </span>
                                          </label>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                              </div>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                    <div class="ti-option__confirm mt50">
                      <button class="c-btn-rect" type="submit"><span class="c-btn-rect__txt">お支払い入力へ進む</span></button>
                    </div>
                  </form>
                  <div class="ti-option__confirm mt50">
                    <h4 class="note_title">注意事項</h4>
                    <p class="note_txt">ダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキスト</p>
                  </div>
                  <div class="ti-body__back">
                    <div class="ti-back"><a class="ti-back__link" href=""><span class="ti-back__link-arrow" aria-hidden="true"></span><span class="ti-back__link-txt">戻る</span></a></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
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
@endsection
