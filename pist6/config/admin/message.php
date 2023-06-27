<?php

return [
    'error' => [
        'admin_user' => [
            'list' => '【ユーザー】一覧情報取得時エラー',
            'edit' => '【ユーザー】更新情報取得時エラー'
        ],
        'transfer_user' => [
            'list'      => '【データ移行新規会員登録一覧】一覧情報取得時エラー',
            'detail'    => '【データ移行新規会員登録一覧】詳細情報取得時エラー',
            'edit'      => '【データ移行新規会員登録一覧】更新情報取得時エラー'
        ],
        'transfer_user_search' => [
            'list'      => '【データ移行新規会員登録検索】一覧情報取得時エラー',
            'search'    => '【データ移行新規会員登録検索】検索情報取得時エラー',
            'download'  => '【データ移行新規会員登録検索】CSVダウンロード時エラー'
        ],
        'payment' => [
            'list'   => '【購入履歴】一覧情報取得時エラー',
            'show'   => '【購入履歴】詳細情報取得時エラー',
            'update' => '【購入履歴】ステータス更新時エラー',
            'search' => '【購入履歴】検索時エラー',
            'clear'  => '【購入履歴】検索条件削除時エラー',
            'veritrans_status' => '決済ステータスの取得に失敗しました',
            'federate_error_head'  => '連携エラー（決済の成否が不明）です。',
            'federate_error_tail' => 'Veritransの管理画面から決済状況を確認してください。',
        ],
        'old_user' => [
            'list'      => '【旧会員基盤ユーザー一覧】一覧情報取得時エラー',
            'detail'    => '【旧会員基盤ユーザー一覧】詳細情報取得時エラー'
        ],
        'original_user' => [
            'list'      => '【元会員基盤ユーザー一覧】一覧情報取得時エラー',
            'detail'    => '【元会員基盤ユーザー一覧】詳細情報取得時エラー'
        ],
    ],
    'code' => [
        'pe_txn_type' => [
            'authorize' => '決済請求',
            'bank_select' => '金融機関選択',
            'paid_confirm' => '入金確認',
            'capture' => '収納情報通知',
        ],
        'command_card' => [
            'Authorize' => '認可申込',
            'Verify' => '検証',
            'AuthorizeNotify' => '認可通知',
            'AuthorizeConfirm' => '認可確認',
            'VerifyNotify' => '検証通知',
            'ResultRedirect' => '結果リダイレクト',
        ],
    ],
];
