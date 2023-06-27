<?php

return [
    // 異常系メッセージ
    'error' => [
        'mpi' => [
            'bad_request'      => '【クレジットカード（3D認証】リクエストエラー',
            'bad_response'     => '【クレジットカード（3D認証）】レスポンスエラー',
            'bad_notification' => '【クレジットカード（3D認証）】不正な通知アクセス',
            'db'               => [
                'insert' => '【クレジットカード（3D認証）】【DB】データ挿入時エラー',
                'update' => '【クレジットカード（3D認証）】【DB】データ更新時エラー',
            ],
            'card_remove' => 'クレジットカード「#0」の削除に失敗しました',
        ],
        'paypay' => [
            'bad_request'  => '【PayPay】リクエストエラー',
            'bad_response' => '【PayPay】レスポンスエラー',
            'db' => [
                'insert' => '【PayPay】【DB】データ挿入時エラー',
                'update' => '【PayPay】【DB】データ更新時エラー',
            ],
            'push' => '【PayPay】【PUSH通知】結果通知データの検証に失敗しました',
        ],
        'netbank' => [
            'bad_request'  => '【ネットバンク】リクエストエラー',
            'bad_response' => '【ネットバンク】レスポンスエラー',
            'db'           => [
                'insert' => '【ネットバンク】【DB】データ挿入時エラー',
                'update' => '【ネットバンク】【DB】データ更新時エラー',
            ],
            'push' => '【ネットバンク】【PUSH通知】結果通知データの検証に失敗しました',
        ],
    ],
    // 正常系メッセージ
    'success' => [
        'mpi' => [
            'card_remove' => 'クレジットカード「#0」を一覧から削除しました'
        ],
        'netbank' => [
            'db'   => [
                'update' => '【ネットバンク】【DB】データ更新成功',
            ],
            'push' => '【ネットバンク】【PUSH通知】結果通知データの検証に成功しました',
        ],
        'paypay' => [
            'db'   => [
                'update' => '【PayPay】【DB】データ更新成功',
            ],
            'push' => '【PayPay】【PUSH通知】結果通知データの検証に成功しました',
        ],
    ],
    // 確認メッセージ
    'confirm' => [
        'mpi' => [
            'card_remove' => 'クレジットカード「#0」を一覧から削除しますか？',
        ]
    ]
];
