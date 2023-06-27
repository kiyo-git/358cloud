@extends('auth.app')
@section('title', 'パスワードリセット')
@section('content')
    <div class="l-content">
      <div class="l-signup-flow">
        <section class="l-regist _signup-input">
          <div class="l-regist__inner">
            <div class="l-regist__body nontitle">
              <div class="rg-body">
                <div class="rg-body__regist">
                  <section class="rg-regist _regist">
                    <div class="rg-regist__inner">
                      <header class="rg-regist__header">
                        <h2 class="rg-regist__header-txt al">パスワードリセット</h2>
                      </header>
                      <form action="{{ route('password.email') }}" method="POST" class="rg-regist__body">
                        @csrf
                        <div class="pl50 pb30 pr50 fw600 al fs14 " style="box-sizing:border-box; display: block;">
                            <x-auth-session-status class="fs16 rg-regist__body nobg ac" :status="session('status')" />
                        </div>

                        <div class="rg-regist__info">
                            @if ($errors->any())
                              <div class="pl50 pb30 pr50 fw600 al fs14 "
                                  style="box-sizing:border-box; display: block;">
                                  <ul style="display: block;">
                                      @foreach ($errors->all() as $error)
                                          <li style="color:#ff354a;" class="mb10">
                                              {{ $error }}</li>
                                      @endforeach
                                  </ul>
                              </div>
                          @endif
                          <div class="rg-regist__info-item">
                            <p class="rg-regist__label">メールアドレス<span class="rg-regist__label-required">必須</span></p>
                            <div class="rg-regist__inputs">
                              <div class="rg-regist__inputs-item">
                                <input class="c-input-text" type="email" name="email" value="" required autofocus>
                              </div>
                            </div>
                          </div>
                          <div class="rg-regist__info-item">
                            <p class="rg-regist__label"></p>
                            <div class="rg-regist__inputs half">
                              <div class="rg-regist__inputs-items">
                                <div class="rg-regist__inputs-item">
                                    <label class="rg-regist__input-label"></label>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="rg-regist__submit">
                          <div class="rg-regist__submit-inner">
                            <button class="c-btn-rect brid30" type="submit"><span class="c-btn-rect__txt">リセットリンクの送信</span></button>
                          </div>
                        </div>
                    </form>
                      <div class="rg-regist__body nobg ac fs16"><a class="dib" href="{{ route('login') }}">▶ログインはこちら</a></div>
                    </div>
                  </section>
                </div>
              </div>
            </div>
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
@endsection
