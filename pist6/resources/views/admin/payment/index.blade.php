@php
    use App\Models\TicketOrderPayment;
    // debug_mode
    // dd($params);
@endphp
@extends('admin.app')
@section('title', '購入履歴検索画面')
@section('content')
    <form id="search" name="form" action="{{ route('admin.payment.search') }}" method="get">
        @csrf
        <p class="content-title">購入履歴検索画面</p>
        <div class="form-content">
            <div class="form-group">
                <div class="form-group-label">
                    <label for="order_id">
                        購入ID
                    </label>
                </div>
                <div class="form-group-input">
                    <input type="text" name="order_id" value="{{$params['order_id'] ?? ''}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-3/4 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
            </div>
            <div class="form-group">
                <div class="form-group-label">
                    <label for="veritrans_order_id">
                        決済ID
                    </label>
                </div>
                <div class="form-group-input">
                    <input type="text" name="veritrans_order_id" value="{{$params['veritrans_order_id']  ?? ''}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-3/4 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
            </div>
            <div class="form-group">
                <div class="form-group-label">
                    <label for="user_id">
                        ユーザーID
                    </label>
                </div>
                <div class="form-group-input">
                    <input type="text" name="user_id" id="name" value="{{$params['user_id'] ?? ''}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-3/4 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
            </div>
            <div class="form-group">
                <div class="form-group-label">
                    <label for="total_amount">
                        決済金額
                    </label>
                </div>
                <div class="form-group-input flex">
                    <input type="number" min="0" max="2147483647" name="total_amount_min" value="{{$params['total_amount_min'] ?? ''}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-1/4 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <div class="w-5 justify-center" style="display:inline-block; margin:5px 10px;"><span>〜</span></div>
                    {{-- maxはとりあえずMySQLのintの最大値 --}}
                    <input type="number" min="0" max="2147483647" name="total_amount_max" value="{{$params['total_amount_max'] ?? ''}}" class="bg-gray-50 ml-1 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-1/4 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
            </div>
            <div class="form-group">
                <div class="form-group-label">
                    <label for="request_date">
                        購入依頼日時
                    </label>
                </div>
                <div class="form-group-input flex">
                    <input type="date" name="request_from" value="{{$params['request_from'] ?? ''}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-1/4 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <div class="w-5 justify-center" style="display:inline-block; margin:5px 10px;"><span>〜</span></div>
                    <input type="date" name="request_to" value="{{$params['request_to'] ?? ''}}" class="bg-gray-50 ml-1 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-1/4 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
            </div>
            <div class="form-group">
                <div class="form-group-label">
                    <label for="completed_date">
                        決済完了日時
                    </label>
                </div>
                <div class="form-group-input flex">
                    <input type="date" name="completed_from" value="{{$params['completed_from'] ?? ''}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-1/4 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <div class="w-5 justify-center" style="display:inline-block; margin:5px 10px;"><span>〜</span></div>
                    <input type="date" name="completed_to" value="{{$params['completed_to'] ?? ''}}" class="bg-gray-50 ml-1 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-1/4 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
            </div>
            <div class="form-group">
                <div class="form-group-label">
                    <label for="method">
                        支払い方法
                    </label>
                </div>
                <div class="form-group-input">
                    <select name="method" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-3/4 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="">
                        <option value="">全て</option>
                        @foreach(TicketOrderPayment::METHOD as $index => $name)
                            <option value="{{$index}}"
                                @isset( $params['method'])
                                    @if( $params['method'] == $index ) selected @endif
                                @endisset
                            >
                                    {{$name}}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="form-group-label">
                    <label for="status">
                        購入ステータス
                    </label>
                </div>
                <div class="form-group-input">
                    <select name="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-3/4 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="">
                        <option value="">全て</option>
                        @foreach(TicketOrderPayment::STATUS as $index => $name)
                            <option value="{{$index}}"
                                @isset( $params['status'] )
                                    @if( $params['status'] == $index ) selected @endif
                                @endisset
                            >
                                {{$name}}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="text-center mt-3 w-100">
            <button type="button" onclick="window.location='/admin/payment/clear'" class="secondary-button text-center bg-white border border-gray-300 rounded-md font-semibold text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                クリア
            </button>
            <button form="search" type="submit" class="primary-button w-1/2 text-center bg-gray-800 border border-transparent rounded-md font-semibold text-white uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                検索
            </button>
            <button form="download" type="submit" class="secondary-button text-center bg-white border border-gray-300 rounded-md font-semibold text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                CSVダウンロード
            </button>
        </div>
    </form>
    <form id="download" name="form" action="{{ route('admin.payment.download') }}" method="post">@csrf</form>
    <div style="margin-top: 3%;">
        <table class="table-list w-full text-gray-500 dark:text-gray-400">
            <thead>
                <tr>
                    <th>購入ID</th>
                    <th>決済ID</th>
                    <th>ユーザーID</th>
                    <th>決済金額</th>
                    <th>購入依頼日時</th>
                    <th>決済完了日時</th>
                    <th>支払い方法</th>
                    <th>購入ステータス</th>
                    <th>決済ステータス</th>
                    <th colspan="2"></th>
                </tr>
            </thead>
            <tbody>
                @if(!$ticket_orders->isEmpty())
                    @foreach ($ticket_orders as $order)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="px-6 py-4 text-center">{{ $order->ticket_order_id }}</td>
                            <td class="px-6 py-4 text-center">{{ $order->veritrans_order_id }}</td>
                            <td class="px-6 py-4 text-center">{{ $order->user_id }}</td>
                            <td class="px-6 py-4 text-center">{{ number_format($order->total_amount) }}円</td>
                            <td class="px-6 py-4 text-center">{{ date('Y/m/d H:i:s', strtotime($order->requested_at)) }}</td>
                            <td class="px-6 py-4 text-center">
                                {{ $order->completed_at != null ? date('Y/m/d H:i:s', strtotime($order->completed_at)) : '-' }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                {{ TicketOrderPayment::METHOD[$order->method] }}
                            </td>
                            <td class="px-6 py-4 text-center" @if($order->status == TicketOrderPayment::STATUS_ERROR || $order->status == TicketOrderPayment::STATUS_FEDERATE_ERROR || $order->status == TicketOrderPayment::STATUS_OVERTIME || $order->status == TicketOrderPayment::STATUS_CANCEL ) style="color: red;" @endif>
                                {{ TicketOrderPayment::STATUS[$order->status] }}
                            </td>
                            <td class="px-6 py-4 text-center" @if(!(array_key_exists($order->ticket_order_id, $success_all) && $success_all[$order->ticket_order_id])) style="color: red;" @endif>
                                {{-- 下記で「(不明)」としているのは、レコードが存在してかつVeritransから結果が帰ってこなかった場合。 --}}
                                {{-- 現状考えうるのは、ローカルかステージングにおいて何らかの理由で$request_data->setContainDummyFlag(true);が実行されなかった場合のみなので、通常は「(不明)」にはならない。 --}}
                                {{ array_key_exists($order->ticket_order_id, $veritrans_order_status) ? $veritrans_order_status[$order->ticket_order_id] : '(不明)' }}
                            </td>
                            <td class="px-6 py-4 text-center"><a href="{{ route('admin.payment.show', ['id' => $order->ticket_order_id]) }}">Edit</a></td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
        <div style="margin-top: 3%;">
            {{ $ticket_orders->links('vendor.pagination.admin.tailwind') }}
        </div>
    </div>
@endsection
