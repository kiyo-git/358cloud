@extends('auth.app')
@section('title', '会員登録| PIST6オフィシャルサイト')
@section('content')
    <div class="l-content">
      <div class="l-signup-flow">
        <div class="rg-flow">
          <div class="rg-flow__inner">
            <ul class="rg-flow__list">
              <li class="rg-flow__item is-current">
                <p class="rg-flow__step"><span class="rg-flow__step-num">STEP1:<span class="rg-flow__step-status">お客様情報入力</span></span></p>
              </li>
              <li class="rg-flow__item">
                <p class="rg-flow__step"><span class="rg-flow__step-num">STEP2:<span class="rg-flow__step-status">確認</span></span></p>
              </li>
              <li class="rg-flow__item">
                <p class="rg-flow__step"><span class="rg-flow__step-num">STEP3:<span class="rg-flow__step-status">完了</span></span></p>
              </li>
            </ul>
          </div>
        </div>
        <section class="l-regist _signup-input">
          <div class="l-regist__inner">
            <header class="l-regist__header">
              <div class="rg-header">
                <div class="rg-header__inner">
                  <h2 class="rg-header__ttl"><span class="rg-header__ttl-purpose">基本情報登録<span class="rg-header__ttl-action">お客様情報の入力</span></span></h2>
                </div>
              </div>
            </header>
            <div class="l-regist__body">
              <div class="rg-body">
                <div class="rg-body__regist">
                  <section class="rg-regist _regist">
                    <div class="rg-regist__inner">
                      <header class="rg-regist__header">
                        <h2 class="rg-regist__header-txt">お客様情報の入力</h2>
                      </header>
                      <form action="{{ route('user.confirm') }}" method="POST"  class="rg-regist__body">
                        @csrf
                        <div class="rg-regist__info">
                            @if ($errors->any())
                                <div class="pl50 pb30 pr50 fw600 al fs14 "style="box-sizing:border-box; display: block;">
                                     <ul style="display: block;">
                                     @foreach ($errors->all() as $error)
                                        <li style="color:#ff354a;" class="mb10">{{ $error }}</li>
                                     @endforeach
                                     </ul>
                                </div>
                             @endif
                          <div class="rg-regist__info-item">
                            <p class="rg-regist__label">名前<span class="rg-regist__label-required">必須</span></p>
                            <div class="rg-regist__inputs half">
                              <div class="rg-regist__inputs-item">
                                <input class="c-input-text" type="text" name="family_name" value="{{old('family_name')??null}}">
                              </div>
                              <div class="rg-regist__inputs-item">
                                <input class="c-input-text" type="text" name="given_name" value="{{old('given_name')??null}}">
                              </div>
                            </div>
                          </div>
                          <div class="rg-regist__info-item">
                            <p class="rg-regist__label">フリガナ<span class="rg-regist__label-required">必須</span></p>
                            <div class="rg-regist__inputs half">
                              <div class="rg-regist__inputs-item">
                                <input class="c-input-text" type="text" name="family_name_kana" pattern="[\u30A1-\u30F6]*" value="{{old('family_name_kana')??null}}">
                              </div>
                              <div class="rg-regist__inputs-item">
                                <input class="c-input-text" type="text" name="given_name_kana" pattern="[\u30A1-\u30F6]*" value="{{old('given_name_kana')??null}}">
                              </div>
                            </div>
                          </div>
                          <div class="rg-regist__info-item">
                            <p class="rg-regist__label">生年月日<span class="rg-regist__label-required">必須</span></p>
                            <div class="rg-regist__inputs w30">
                              <div class="rg-regist__inputs-item">
                                <div class="c-input-select"><span class="c-input-select__icon" aria-hidden="ture"></span>
                                  <select name="year" class="c-input-select__body">
                                    @if(old('year'))
                                    <option value="" disabled="disabled">選択してください</option>
                                    <option value="{{ old('year') }}" selected="selected">{{ old('year') }}</option>
                                    @else
                                    <option value="" selected="selected" disabled="disabled">選択してください</option>
                                    @endif
                                    @for($i = 1920; $i<=2010; $i++)
                                      @if($i == 1970)
                                        <option value="{{$i}}" selected>{{$i}}</option>
                                        @continue
                                      @endif
                                        <option value="{{$i}}">{{$i}}</option>
                                    @endfor
                                  </select>
                                </div>
                              </div>
                              <div class="rg-regist__inputs-item">
                                <div class="c-input-select"><span class="c-input-select__icon" aria-hidden="ture"></span>
                                  <select name="month" class="c-input-select__body">
                                    @if(old('month'))
                                    <option value="" disabled="disabled">選択してください</option>
                                    <option value="{{ old('month') }}" selected="selected">{{ old('month') }}</option>
                                   @else
                                    <option value="" selected="selected" disabled="disabled">選択してください</option>
                                    @endif
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                  </select>
                                </div>
                              </div>
                              <div class="rg-regist__inputs-item">
                                <div class="c-input-select"><span class="c-input-select__icon" aria-hidden="ture"></span>
                                  <select name="day" class="c-input-select__body">
                                    @if(old('day'))
                                    <option value="" disabled="disabled">選択してください</option>
                                    <option value="{{ old('day') }}" selected="selected">{{ old('day') }}</option>
                                    @else
                                    <option value="" selected="selected" disabled="disabled">選択してください</option>
                                   @endif
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                    <option value="13">13</option>
                                    <option value="14">14</option>
                                    <option value="15">15</option>
                                    <option value="16">16</option>
                                    <option value="17">17</option>
                                    <option value="18">18</option>
                                    <option value="19">19</option>
                                    <option value="20">20</option>
                                    <option value="21">21</option>
                                    <option value="22">22</option>
                                    <option value="23">23</option>
                                    <option value="24">24</option>
                                    <option value="25">25</option>
                                    <option value="26">26</option>
                                    <option value="27">27</option>
                                    <option value="28">28</option>
                                    <option value="29">29</option>
                                    <option value="30">30</option>
                                    <option value="31">31</option>
                                  </select>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="rg-regist__info-item">
                            <p class="rg-regist__label">電話番号<span class="rg-regist__label-required">必須</span></p>
                            <div class="rg-regist__inputs">
                              <div class="rg-regist__inputs-item">
                                <input class="c-input-text" type="number" name="phone_number" value="{{old('phone_number')??null}}">
                              </div>
                            </div>
                          </div>
                          <div class="rg-regist__info-item">
                            <div class="pb20 mt20 text-center" style="display:block;width:100%;">
                              <p class="" id="zip_err" style="color:#ff354a;"></p>
                            </div>
                            <p class="rg-regist__label">郵便番号<span class="rg-regist__label-required">必須</span></p>
                            <div class="rg-regist__inputs">
                              <div class="rg-regist__inputs-item" style="width: 45%; margin-right: 4%;">
                                <input class="c-input-text" id="zip_code" type="text" name="zip_code" value="{{old('zip_code')??null}}" maxlength="7" oninput="value = value.replace(/[^0-9]+/i,'');">
                              </div>
                              <button class="c-btn-rect" id="zip_search" type="button" style="width:48%; padding: 1.25rem 0px;"><span class="c-btn-rect__txt">住所検索</span></button>
                            </div>
                          </div>
                          <div class="rg-regist__info-item">
                            <p class="rg-regist__label">住所[都道府県]<span class="rg-regist__label-required">必須</span></p>
                            <div class="rg-regist__inputs">
                              <div class="rg-regist__inputs-item">
                                <div class="c-input-select"><span class="c-input-select__icon" aria-hidden="ture"></span>
                                  <select id="prefecture" name='prefecture' class="c-input-select__body">
                                    @if(old('prefecture'))
                                    <option value="" disabled="disabled">選択してください</option>
                                    <option value="{{old('prefecture') }}" selected="selected">{{old('prefecture')}}</option>
                                    @else
                                    <option value="" selected="selected" disabled="disabled">選択してください</option>
                                    @endif
                                    <option value="北海道" data-prefcode="1">北海道</option>
                                    <option value="青森県" data-prefcode="2">青森県</option>
                                    <option value="岩手県" data-prefcode="3">岩手県</option>
                                    <option value="宮城県" data-prefcode="4">宮城県</option>
                                    <option value="秋田県" data-prefcode="5">秋田県</option>
                                    <option value="山形県" data-prefcode="6">山形県</option>
                                    <option value="福島県" data-prefcode="7">福島県</option>
                                    <option value="茨城県" data-prefcode="8">茨城県</option>
                                    <option value="栃木県" data-prefcode="9">栃木県</option>
                                    <option value="群馬県" data-prefcode="10">群馬県</option>
                                    <option value="埼玉県" data-prefcode="11">埼玉県</option>
                                    <option value="千葉県" data-prefcode="12">千葉県</option>
                                    <option value="東京都" data-prefcode="13">東京都</option>
                                    <option value="神奈川県" data-prefcode="14">神奈川県</option>
                                    <option value="新潟県" data-prefcode="15">新潟県</option>
                                    <option value="富山県" data-prefcode="16">富山県</option>
                                    <option value="石川県" data-prefcode="17">石川県</option>
                                    <option value="福井県" data-prefcode="18">福井県</option>
                                    <option value="山梨県" data-prefcode="19">山梨県</option>
                                    <option value="長野県" data-prefcode="20">長野県</option>
                                    <option value="岐阜県" data-prefcode="21">岐阜県</option>
                                    <option value="静岡県" data-prefcode="22">静岡県</option>
                                    <option value="愛知県" data-prefcode="23">愛知県</option>
                                    <option value="三重県" data-prefcode="24">三重県</option>
                                    <option value="滋賀県" data-prefcode="25">滋賀県</option>
                                    <option value="京都府" data-prefcode="26">京都府</option>
                                    <option value="大阪府" data-prefcode="27">大阪府</option>
                                    <option value="兵庫県" data-prefcode="28">兵庫県</option>
                                    <option value="奈良県" data-prefcode="29">奈良県</option>
                                    <option value="和歌山県" data-prefcode="30">和歌山県</option>
                                    <option value="鳥取県" data-prefcode="31">鳥取県</option>
                                    <option value="島根県" data-prefcode="32">島根県</option>
                                    <option value="岡山県" data-prefcode="33">岡山県</option>
                                    <option value="広島県" data-prefcode="34">広島県</option>
                                    <option value="山口県" data-prefcode="35">山口県</option>
                                    <option value="徳島県" data-prefcode="36">徳島県</option>
                                    <option value="香川県" data-prefcode="37">香川県</option>
                                    <option value="愛媛県" data-prefcode="38">愛媛県</option>
                                    <option value="高知県" data-prefcode="39">高知県</option>
                                    <option value="福岡県" data-prefcode="40">福岡県</option>
                                    <option value="佐賀県" data-prefcode="41">佐賀県</option>
                                    <option value="長崎県" data-prefcode="42">長崎県</option>
                                    <option value="熊本県" data-prefcode="43">熊本県</option>
                                    <option value="大分県" data-prefcode="44">大分県</option>
                                    <option value="宮崎県" data-prefcode="45">宮崎県</option>
                                    <option value="鹿児島県" data-prefcode="46">鹿児島県</option>
                                    <option value="沖縄県" data-prefcode="47">沖縄県</option>
                                  </select>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="rg-regist__info-item">
                            <p class="rg-regist__label">住所 [市区町村]<span class="rg-regist__label-required">必須</span></p>
                            <div class="rg-regist__inputs">
                              <div class="rg-regist__inputs-item">
                                <input id="city" class="c-input-text" type="text" name="city" value="{{old('city')??null}}">
                              </div>
                            </div>
                          </div>
                          <div class="rg-regist__info-item">
                            <p class="rg-regist__label">住所 [番地]<span class="rg-regist__label-required">必須</span></p>
                            <div class="rg-regist__inputs">
                              <div class="rg-regist__inputs-item">
                                <input id="block" class="c-input-text" type="text" name="block" value="{{old('block')??null}}">
                              </div>
                            </div>
                          </div>
                          <div class="rg-regist__info-item">
                            <p class="rg-regist__label">住所 [マンション名・号室]</p>
                            <div class="rg-regist__inputs">
                              <div class="rg-regist__inputs-item">
                                <input class="c-input-text" type="text" name="buliding" value="{{old('buliding')??null}}">
                              </div>
                            </div>
                          </div>
                          <div class="rg-regist__info-item">
                            <p class="rg-regist__label">メールアドレス<span class="rg-regist__label-required">必須</span></p>
                            <div class="rg-regist__inputs">
                              <div class="rg-regist__inputs-item">
                                <input class="c-input-text" type="email" name="email" value="{{$email??old('email')??null}}" readonly>
                              </div>
                            </div>
                          </div>
                          <div class="rg-regist__info-item">
                            <p class="rg-regist__label">パスワード<span class="rg-regist__label-required">必須</span></p>
                            <div class="rg-regist__inputs">
                              <div class="rg-regist__inputs-item">
                                <input class="c-input-text" type="password" name="password" value="" pattern="^(?=.*?[a-zA-Z])(?=.*?\d)[a-zA-Z\d]{8,15}$"  required>
                              </div>
                            </div>
                          </div>
                          <div class="rg-regist__info-item">
                            <p class="rg-regist__label">パスワード[確認]<span class="rg-regist__label-required">必須</span></p>
                            <div class="rg-regist__inputs">
                              <div class="rg-regist__inputs-item">
                                <input class="c-input-text" type="password" name="password_confirmation" value="" required>
                              </div>
                            </div>
                            <p class="mt30 fs14">英数字の組み合わせで8文字以上15文字以内を使用し、パスワードを作成ください。</p>
                          </div>
                          <div class="rg-regist__info-item">
                            <p class="rg-regist__label">PIST6の最新情報などを<br class="u-disp-pc">お届けするメールニュースを<br class="u-disp-pc">配信します。</p>
                            <div class="rg-regist__inputs half">
                              <div class="rg-regist__inputs-items">
                                <div class="rg-regist__inputs-item">
                                  <label class="rg-regist__input-label">
                                    <div class="c-input-check">
                                      <input class="c-input-check__body" type="radio" name="mailmagazine" value="1" @if(0 !== old('mailmagazine')) checked="checked" @endif><span class="c-input-check__marker" aria-hidden="true"></span>
                                    </div><span class="rg-regist-term__input-txt">受け取る</span>
                                  </label>
                                </div>
                                <div class="rg-regist__inputs-item">
                                  <label class="rg-regist__input-label">
                                    <div class="c-input-check">
                                      <input class="c-input-check__body" type="radio" name="mailmagazine" value="0" @if(0 === old('mailmagazine')) checked="checked" @else @endif><span class="c-input-check__marker" aria-hidden="true"></span>
                                    </div><span class="rg-regist-term__input-txt">受け取らない</span>
                                  </label>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="rg-regist__term">
                          <div class="rg-regist__term-inner">
                            <div class="rg-regist-term">
                              <div class="rg-regist-term__pages">
                                <div class="rg-regist-term__pages-item">
                                  <p class="rg-regist-term__ttl">利用規約は<a class="rg-regist-term__link" href="https://pist6.com/guide/service-guide/terms/" target="_blank"><span class="rg-regist-term__link-txt">こちら</span></a></p>
                                </div>
                                <div class="rg-regist-term__pages-item">
                                  <p class="rg-regist-term__ttl">プライバシーポリシーは<a class="rg-regist-term__link" href="https://mixi.co.jp/privacy/" target="_blank"><span class="rg-regist-term__link-txt">こちら</span></a></p>
                                </div>
                              </div>
                              <div class="rg-regist-term__input">
                                <label class="rg-regist-term__target">
                                  <div class="c-input-check">
                                    <input class="c-input-check__body" type="checkbox" name="term"><span class="c-input-check__marker" aria-hidden="true"></span>
                                  </div><span class="rg-regist-term__input-txt">上記規約に同意する</span>
                                </label>
                              </div>
                            </div>
                          </div>
                        </div>
                        <input type="hidden" name='confirm_email' value="{{$email??old('confirm_email')}}">
                        <div class="rg-regist__submit">
                          <div class="rg-regist__submit-inner">
                            <p id="zip_exist" style="color:#ff354a;" class="mb10"></p>
                            <button id="form_btn" class="c-btn-rect" type="submit"><span class="c-btn-rect__txt">入力内容を確認する</span></button>
                          </div>
                        </div>
                    </form>
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
