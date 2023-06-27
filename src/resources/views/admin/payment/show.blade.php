@php
    use App\Models\TicketOrderPayment;
@endphp
@extends('admin.app')
@section('title', '購入履歴検索画面 - 詳細')
@section('content')
    <form name="form" action="{{ route('admin.payment.update') }}" method="post">
        @csrf
        <input type="hidden" name="order_id" value="{{$ticket_order->ticket_order_id}}">
        <input type="hidden" name="veritrans_order_id" value="{{$ticket_order->veritrans_order_id}}">
        <p class="content-title">購入履歴検索画面 - 詳細</p>
        <div class="form-content">
            <div class="form-group">
                <div class="form-group-label">
                    <label>
                        購入ID
                    </label>
                </div>
                <div class="form-group-input">
                    {{ $ticket_order->ticket_order_id }}
                </div>
            </div>
            <div class="form-group">
                <div class="form-group-label">
                    <label>
                        決済ID
                    </label>
                </div>
                <div class="form-group-input">
                    {{ $ticket_order->veritrans_order_id }}
                </div>
            </div>
            <div class="form-group">
                <div class="form-group-label">
                    <label>
                        ユーザーID
                    </label>
                </div>
                <div class="form-group-input">
                    {{ $ticket_order->user_id }}
                </div>
            </div>
            <div class="form-group">
                <div class="form-group-label">
                    <label>
                        氏名
                    </label>
                </div>
                <div class="form-group-input">
                    {{ $ticket_order->family_name . ' ' .  $ticket_order->given_name}}
                </div>
            </div>
            <div class="form-group">
                <div class="form-group-label">
                    <label>
                        決済金額
                    </label>
                </div>
                <div class="form-group-input">
                    {{ number_format($ticket_order->total_amount) }}円
                </div>
            </div>
            <div class="form-group">
                <div class="form-group-label">
                    <label>
                        購入依頼日時
                    </label>
                </div>
                <div class="form-group-input">
                    {{ date('Y/m/d H:i:s', strtotime($ticket_order->requested_at)) }}
                </div>
            </div>
            @if($ticket_order->completed_at != null)
                <div class="form-group">
                    <div class="form-group-label">
                        <label>
                            決済完了日時
                        </label>
                    </div>
                    <div class="form-group-input">
                        {{ date('Y/m/d H:i:s', strtotime($ticket_order->completed_at)) }}
                    </div>
                </div>
            @endif
            <div class="form-group">
                <div class="form-group-label">
                    <label>
                        支払い方法
                    </label>
                </div>
                <div class="form-group-input">
                    {{ TicketOrderPayment::METHOD[$ticket_order->method] }}
                </div>
            </div>
            <div class="form-group">
                <div class="form-group-label">
                    <label>
                        購入ステータス
                    </label>
                </div>
                <div class="form-group-input">
                    <div style="display: flex; flex-direction: column;">
                        <select name="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-3/4 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="">
                            @foreach(TicketOrderPayment::STATUS as $index => $name)
                                <option value="{{$index}}"
                                        @if( $index === $ticket_order->status ) selected @endif>{{$name}}
                                </option>
                            @endforeach
                        </select>
                        <span>
                            @if($ticket_order->status == TicketOrderPayment::STATUS_FEDERATE_ERROR)
                                <span style="color: red;">
                                    {{ config('admin.message.error.payment.federate_error_head') }}
                                </span>
                                <a style="color: rgb(0, 0, 238); text-decoration-line: underline;" href="https://pay.veritrans.co.jp/maps">{{ config('admin.message.error.payment.federate_error_tail') }}</a>
                            @endif
                        </span>
                    </div>
                </div>
            </div>
            @foreach($payment_status as $payment_status_row)
                <div class="form-group" style="height: 100px;">
                    <div class="form-group-label">
                        <label>
                            <div style="display: flex; flex-direction: column;">
                                <span>決済ステータス（{{ $payment_status_row['title_detail'] }}）</span>
                            </div>
                        </label>
                    </div>
                    <div class="form-group-input" style="display: flex; flex-direction: column;">
                        <div>
                            <span style="{{ $payment_status_row['result_is_success1'] ? 'color: lightgreen;' : 'color: red;' }}">●</span>
                            {{ $payment_status_row['message1'] }}（決済結果コード：{{ $payment_status_row['vresultcode1'] }}）
                        </div>
                        <hr>
                        <div>
                            <span style="{{ $payment_status_row['result_is_success2'] ? 'color: lightgreen;' : 'color: red;' }}">●</span>
                            {{ $payment_status_row['message2'] }}（決済結果コード：{{ $payment_status_row['vresultcode2'] }}）
                        </div>
                        <hr>
                        <div>
                            <span style="{{ $payment_status_row['result_is_success3'] ? 'color: lightgreen;' : 'color: red;' }}">●</span>
                            {{ $payment_status_row['message3'] }}（決済結果コード：{{ $payment_status_row['vresultcode3'] }}）
                        </div>
                        <hr>
                        <div>
                            <span style="{{ $payment_status_row['result_is_success4'] ? 'color: lightgreen;' : 'color: red;' }}">●</span>
                            {{ $payment_status_row['message4'] }}（決済結果コード：{{ $payment_status_row['vresultcode4'] }}）
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="form-group" style="height: 420px;">
                <div class="form-group-label">
                    <label>
                        補足
                    </label>
                </div>
                <div class="form-group-input" style="height: 420px; margin-top: 20px;">
                    <textarea name="remark" row="10" col="100" style="height: 400px;" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-3/4 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">{{ $ticket_order['remark'] }}</textarea>
                </div>
            </div>
        </div>
        <div class="text-center mt-3 w-100">
            <button type="button" onclick="window.location='/admin/payment/list'" class="secondary-button ml-4 px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                一覧に戻る
            </button>
            <button type="submit" id="updateBtn" class="primary-button w-1/2 text-center bg-gray-800 border border-transparent rounded-md font-semibold text-white uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                編集完了
            </button>
        </div>
    </form>
@endsection
