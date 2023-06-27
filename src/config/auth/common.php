<?php

return [
    'twilio' => [
        'account_sid'      => env('TWILIO_ACCOUNT_SID'),
        'verification_sid' => env('TWILIO_VERIFICATION_SID'),
        'auth_token'       => env('TWILIO_AUTH_TOKEN'),
        'from'             => env('TWILIO_FROM'),
        'national_code'    => '+81',
    ],
    'mail' => [
        'subject' => '【portfolio 認証メール】',
    ],
    'Zip_code' => [
        'zip_cloud_url' => 'https://zipcloud.ibsnet.co.jp/api/search?zipcode=',
    ],
];
