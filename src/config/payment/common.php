<?php

return [
    'mpi' => [
        'redirection_url'     => env('APP_URL') . '/payment/mpi/relay',
        // todo: mpi-completeに戻せないか検討する。
        // 2023/05/23時点の実装では、mpi-completeの場合、
        // ORICOの既存カードによる決済が失敗になる。
        //（レスポンスは成功だが、Veritransを見ると失敗になっている）
        // 'service_option_type' => 'mpi-complete',
        'service_option_type'   => 'mpi-company',
        'jpo'                   => '10',
        'with_capture'          => true,
        'verify_timeout'        => 5,
        'device_channel'        => '02',
        'card_number_mask_type' => '1',
        'account_id_prefix'     => env('APP_ENV') . '_',
    ],
    'paypay' => [
        'service_option_type' => 'online',
        'accounting_type'     => '0', //都度決済
        'item_name'           => 'チケット',
        'item_id'             => '1', //使われないが、使用上必須なのでとりあえずは「1」を指定。
        'success_url'         => env('APP_URL') . '/payment/paypay/result?status=success',
        'cancel_url'          => env('APP_URL') . '/payment/paypay/result?status=cancel',
        'error_url'           => env('APP_URL') . '/payment/paypay/result?status=error',
        'push_url'            => env('APP_URL') . '/payment/paypay/push',
    ],
    'netbank' => [
        'service_option_type' => 'netbank-pc',
        'contents'            => 'チケット',
        'contents_kana'       => 'チケット',
        'term_url'            => env('APP_URL') . '/payment/netbank/thanks',
        'push_url'            => env('APP_URL') . '/payment/netbank/push',
    ],
    'token' => [
        'token_api_key' => 'eae43d90-f81d-45e2-be39-063eee7ceb9b'
    ],
    'api' => [
        'url'  => 'https://api.veritrans.co.jp',
        'port' => 443,
    ],
];
