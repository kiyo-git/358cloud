@extends('admin.app')
@if(Request::routeIs('admin.transfer-user.edit'))
@section('title', 'データ移行新規会員画面 - 編集')
@else
@section('title', 'データ移行新規会員画面 - 詳細')
@endif
@section('content')
    <form id="update" action="{{ route('admin.transfer-user.update') }}" method="post">
        @csrf
        <p class="content-title">@if(Request::routeIs('admin.transfer-user.edit'))データ移行新規会員編集画面@else データ移行新規会員詳細画面@endif</p>
            @foreach ($errors->all() as $error)
                <p class="error-text">{{$error}}</p>
            @endforeach
        <div class="form-content">
            <div class="form-group">
                <div class="form-group-label">
                    <label>
                        ID
                    </label>
                </div>
                <div class="form-group-input">
                  {{ $user->id }}
                </div>
            </div>
            @if(!is_null($user->old_user_id))
            <div class="form-group">
                <div class="form-group-label">
                    <label>
                        旧ID
                    </label>
                </div>
                <div class="form-group-input">
                  {{ $user->id }}
                </div>
            </div>
            @endif
            <div class="form-group">
                <div class="form-group-label">
                    <label>
                        名前（姓）
                    </label>
                </div>
                <div class="form-group-input">
                    @if(Request::routeIs('admin.transfer-user.edit'))
                    <input name="family_name" type="text"  value={{ old('family_name')??$user->family_name }} class=" border border-gray-300 text-gray-900 text-sm rounded-lg w-3/4 p-2.5 " {{Request::routeIs('admin.transfer-user.edit')? null:'readonly'}}>
                    @else
                    {{$user->family_name }}
                    @endif
                </div>
            </div>
            <div class="form-group">
                <div class="form-group-label">
                    <label>
                        名前（名）
                    </label>
                </div>
                <div class="form-group-input">
                    @if(Request::routeIs('admin.transfer-user.edit'))
                    <input name="given_name" type="text" value={{ old('given_name')??$user->given_name }} class=" border border-gray-300 text-gray-900 text-sm rounded-lg w-3/4 p-2.5 " {{Request::routeIs('admin.transfer-user.edit')? null:'readonly'}}>
                    @else
                    {{$user->given_name }}
                    @endif
                </div>
            </div>
            <div class="form-group">
                <div class="form-group-label">
                    <label>
                        フリガナ（姓）
                    </label>
                </div>
                <div class="form-group-input">
                    @if(Request::routeIs('admin.transfer-user.edit'))
                    <input type="text" name="family_name_kana" pattern="[\u30A1-\u30F6]*" value={{ old('family_name_kana')??$user->family_name_kana  }} class=" border border-gray-300 text-gray-900 text-sm rounded-lg w-3/4 p-2.5 " {{Request::routeIs('admin.transfer-user.edit')? null:'readonly'}}>
                    @else
                    {{$user->family_name_kana  }}
                    @endif
                </div>
            </div>
            <div class="form-group">
                <div class="form-group-label">
                    <label>
                        フリガナ（名）
                    </label>
                </div>
                <div class="form-group-input">
                    @if(Request::routeIs('admin.transfer-user.edit'))
                    <input type="text" pattern="[\u30A1-\u30F6]*" name="given_name_kana" value={{ old('given_name_kana')??$user->given_name_kana  }} class=" border border-gray-300 text-gray-900 text-sm rounded-lg w-3/4 p-2.5 " {{Request::routeIs('admin.transfer-user.edit')? null:'readonly'}}>
                    @else
                    {{$user->given_name_kana  }}
                    @endif
                </div>
            </div>
            <div class="form-group">
                <div class="form-group-label">
                    <label>
                        生年月日
                    </label>
                </div>
                <div class="form-group-input">
                    @if(Request::routeIs('admin.transfer-user.edit'))
                    <div class="rg-regist__inputs w30">
                        <select name="year" class="border border-gray-300 text-sm rounded-lg  w-1/4 p-2.5 ">
                            <option value="" selected="selected" disabled="disabled">選択してください</option>
                            @if(!is_null(old('year')))
                                @for($i = 1920; $i<=2010; $i++)
                                    <option value="{{$i}}" {{$i!=old('year')?null:'selected'}}>{{$i}}</option>
                                @endfor
                            @else
                                @for($i = 1920; $i<=2010; $i++)
                                    <option value="{{$i}}" {{$i!=$user->year?null:'selected'}}>{{$i}}</option>
                                @endfor
                            @endif
                        </select>
                        <select name="month" class="border border-gray-300 text-sm rounded-lg  w-1/4 p-2.5 ">
                            <option value="" selected="selected" disabled="disabled">選択してください</option>
                            @if(!is_null(old('month')))
                                @for($i = 1; $i<=12; $i++)
                                <option value="{{$i}}" {{$i!=old('month')?null:'selected'}}>{{$i}}</option>
                                @endfor
                            @else
                                @for($i = 1; $i<=12; $i++)
                                <option value="{{$i}}" {{$i!=$user->month?null:'selected'}}>{{$i}}</option>
                                @endfor
                            @endif
                        </select>
                        <select name="day" class="border border-gray-300 text-sm rounded-lg  w-1/4 p-2.5 ">
                            <option value="" selected="selected" disabled="disabled">選択してください</option>
                            @if(!is_null(old('day')))
                                @for($i = 1; $i<=31; $i++)
                                <option value="{{$i}}"{{$i !=old('day')?null:'selected'}}>{{$i}}</option>
                                @endfor
                            @else
                                @for($i = 1; $i<=31; $i++)
                                <option value="{{$i}}"{{$i!=$user->day?null:'selected'}}>{{$i}}</option>
                                @endfor
                            @endif
                        </select>
                      </div>
                    @else
                    {{ $user->birthday }}
                    @endif
                </div>
            </div>
            <div class="form-group">
                <div class="form-group-label">
                    <label>
                        電話番号
                    </label>
                </div>
                <div class="form-group-input">
                    @if(Request::routeIs('admin.transfer-user.edit'))
                    <input name="phone_number" value={{ old('phone_number')??$user->phone_number  }} class=" border border-gray-300 text-gray-900 text-sm rounded-lg  w-1/4 p-2.5 " >
                    @else
                    {{$user->phone_number  }}
                    @endif
                </div>
            </div>
            <div class="form-group">
                <div class="form-group-label">
                    <label>
                        郵便番号
                    </label>
                </div>
                <div class="form-group-input">
                    @if(Request::routeIs('admin.transfer-user.edit'))
                    <input name="zip_code" type="text" value={{ old('zip_code')??$user->zip_code }} class="border border-gray-300 text-gray-900 text-sm rounded-lg  w-1/4 p-2.5 ">
                    @else
                    {{$user->zip_code  }}
                    @endif
                </div>
            </div>
            <div class="form-group">
                <div class="form-group-label">
                    <label>
                        住所[都道府県]
                    </label>
                </div>
                <div class="form-group-input">
                    @if(Request::routeIs('admin.transfer-user.edit'))
                    <select id="prefecture" name='prefecture' class=" border border-gray-300 text-gray-900 text-sm rounded-lg w-3/4 p-2.5 ">
                        <option value="" selected="selected" disabled="disabled">選択してください</option>
                        <option value="{{$user->prefecture}}" selected="selected">{{old('prefecture')??$user->prefecture}}</option>
                        <option value="北海道" data-prefcode="1" >北海道</option>
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
                    @else
                    {{$user->prefecture}}
                    @endif
                </div>
            </div>
            <div class="form-group">
                <div class="form-group-label">
                    <label>
                        住所[市区町村]
                    </label>
                </div>
                <div class="form-group-input">
                    @if(Request::routeIs('admin.transfer-user.edit'))
                    <input name="city" type="text" value={{ old('city')??$user->city }} class=" border border-gray-300 text-gray-900 text-sm rounded-lg w-3/4 p-2.5 ">
                    @else
                    {{ $user->city }}
                    @endif
                </div>
            </div>
            <div class="form-group">
                <div class="form-group-label">
                    <label>
                        住所[番地]
                    </label>
                </div>
                <div class="form-group-input">
                    @if(Request::routeIs('admin.transfer-user.edit'))
                    <input name="block" type="text" value={{ old('block')??$user->block }} class=" border border-gray-300 text-gray-900 text-sm rounded-lg w-3/4 p-2.5 ">
                    @else
                    {{ $user->block }}
                    @endif
                </div>
            </div>
            <div class="form-group">
                <div class="form-group-label">
                    <label>
                        住所[マンション名・号室]
                    </label>
                </div>
                <div class="form-group-input">
                    @if(Request::routeIs('admin.transfer-user.edit'))
                    <input name="building" type="text" class=" border border-gray-300 text-gray-900 text-sm rounded-lg w-3/4 p-2.5" value={{old('buliding')??$user->building??null}}  >
                    @else
                    {{ $user->building }}
                    @endif
                </div>
            </div>
            <div class="form-group">
                <div class="form-group-label">
                    <label for="email">
                        メールアドレス
                    </label>
                </div>
                <input type="hidden" name="email" value="{{ $user->email }}">
                <div class="form-group-input">
                    {{ $user->email }}
                </div>
            </div>
            <div class="form-group">
                <div class="form-group-label">
                    <label for="email">
                        メルマガ登録
                    </label>
                </div>
                <div class="form-group-input">
                    @if(Request::routeIs('admin.transfer-user.edit'))
                    @if(!is_null(old('mailmagazine_flg')))
                    <fieldset>
                        <label>
                            <input type="radio" name="mailmagazine_flg" value='1' checked={{ (old('mailmagazine_flg') === 1)?"checked":null }}>
                            {{ App\Models\User::NEWSLETTER[1] }}
                        </label>
                        <label class="ml-4">
                            <input type="radio" name="mailmagazine_flg" value='0' checked={{ (old('mailmagazine_flg') === 0)?"checked":null }}>
                            {{ App\Models\User::NEWSLETTER[0] }}
                        </label>
                    </fieldset>
                    @else
                    <fieldset>
                        <label>
                            <input type="radio" name="mailmagazine_flg" value='1' checked={{ ($user->mailmagazine_flg = 1)?"checked":null }}>
                            {{ App\Models\User::NEWSLETTER[1] }}
                        </label>
                        <label class="ml-4">
                            <input type="radio" name="mailmagazine_flg" value='0' checked={{ (($user->mailmagazine_flg = 0))?"checked":null }}>
                            {{ App\Models\User::NEWSLETTER[0] }}
                        </label>
                    </fieldset>
                    @endif
                    @else
                    {{ App\Models\User::NEWSLETTER[$user->mailmagazine_flg] }}
                    @endif
                </div>
            </div>
        </div>
        <div class="text-center mt-3 w-100">
            @if(Request::route('prev'))
            <button type="button" onclick="window.location='/admin/transfer-user-search/search'" class="secondary-button ml-4 px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                検索に戻る
            </button>
            @else
            <button type="button" onclick="window.location='/admin/transfer-user'" class="secondary-button ml-4 px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                一覧に戻る
            </button>
            @endif
            @if(Request::routeIs('admin.transfer-user.edit'))
            <input type="hidden" name="old_email" value="{{$user->email}}" readonly>
            <button form="update" type="button" id="updateBtn" class="primary-button w-1/2 ml-4 px-4 ext-center bg-gray-800 border border-transparent rounded-md font-semibold text-white uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                更新する
            </button>
            <button form="delete" id="deleteBtn" type="button" class="danger-button ml-4 px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-white uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                削除する
            </button>
            <input type="hidden" name="id" value="{{ $user->id }}">
            @endif
        </div>
    </form>
    <form id="delete" action="{{ route('admin.transfer-user.delete') }}" method="post">
        @csrf
        <input type="hidden" name="id" value="{{ $user->id }}">
        <input type="hidden" name="email" value="{{ $user->email }}">
    </form>
@endsection
