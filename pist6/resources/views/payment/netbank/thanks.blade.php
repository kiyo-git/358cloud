@extends('payment.app')
@section('title', 'PIST6 取引結果')
@section('content')
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
          <li class="rg-flow__item">
            <div class="ti-flow__num u-disp-sp _step06">
              <div class="ti-flow__num-inner">
                <p class="ti-flow__num-txt"><span class="ti-flow__num-current">6<span class="ti-flow__num-total">/ 7</span></span></p>
              </div>
              <div class="ti-flow__num-circle" aria-hidden="true"></div>
            </div>
            <p class="rg-flow__step"><span class="rg-flow__step-num">STEP6:<span class="rg-flow__step-status">お支払い方法のご確認</span></span></p>
          </li>
          <li class="rg-flow__item is-current">
            <div class="ti-flow__num u-disp-sp _step07">
              <div class="ti-flow__num-inner">
                <p class="ti-flow__num-txt"><span class="ti-flow__num-current">7<span class="ti-flow__num-total">/ 7</span></span></p>
              </div>
              <div class="ti-flow__num-circle" aria-hidden="true"></div>
            </div>
            <p class="rg-flow__step is-current"><span class="rg-flow__step-num">STEP7:<span class="rg-flow__step-status">購入手続き完了</span></span></p>
          </li>
        </ul>
      </div>
    </div>
    <section class="l-regist _signup-input">
      <div class="l-regist__inner">
        <header class="l-regist__header">
          <div class="rg-header">
            <div class="rg-header__inner">
              @isset ( $mErrMsg )
                <h2 class="rg-header__ttl"><span class="rg-header__ttl-purpose">決済失敗</span></h2>
                <p>{{ $mErrMsg }}</p>
              @else
                <h2 class="rg-header__ttl"><span class="rg-header__ttl-purpose">購入完了</span></h2>
                <p class="rg-header__lead">ご購入ありがとうございます。決済が完了しました。</p>
              @endisset
            </div>
          </div>
        </header>
        <div class="l-regist__body nontitle">
          <div class="rg-body">
            <div class="rg-body__regist">
              <section class="rg-regist _regist">
                <div class="rg-regist__inner">
                  <div class="rg-regist__body nobg">
                    <div class="rg-regist__submit">
                      <div class="rg-regist__submit-inner">
                        <button class="c-btn-rect brid30" type="button"><span class="c-btn-rect__txt">購入詳細</span></button>
                      </div>
                    </div>
                  </div>
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
<div class="row">
    <div class="col-md-12">
        <hr class="mb-4">
        <a class="btn btn-primary btn-lg"
           href="{{ action([App\Http\Controllers\Payment\MenuController::class, 'index']) }}">戻る</a>
    </div>
</div>
@endsection
