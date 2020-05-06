<?php

return [
    'version'               => '1.4.1',
    'currency'              => env('CREDITS_CURRENCY', 'USD'),
    'rate'                  => env('CREDITS_RATE', 100), // the amount of credits per 1 unit of the main currency (by default 100 credits = 1 USD)
    'deposit_min'           => env('CREDITS_DEPOSIT_MIN', 100),
    'deposit_max'           => env('CREDITS_DEPOSIT_MAX', 999999999),
    'withdrawal_min'        => env('CREDITS_WITHDRAWAL_MIN', 100),
    'withdrawal_max'        => env('CREDITS_WITHDRAWAL_MAX', 999999999),
    'withdrawal_auto_max'   => env('CREDITS_WITHDRAWAL_AUTO_MAX', 0),
    'min_total_deposit_to_withdraw' => env('CREDITS_MIN_TOTAL_DEPOSIT_TO_WITHDRAW', 0),

    // coinpayments.net API settings
    'coinpayments' => [
        'merchant_id'               => env('COINPAYMENTS_MERCHANT_ID'),
        'public_key'                => env('COINPAYMENTS_PUBLIC_KEY'),
        'private_key'               => env('COINPAYMENTS_PRIVATE_KEY'),
        'secret_key'                => env('COINPAYMENTS_SECRET_KEY'),
        'withdrawals_auto_confirm'  => env('COINPAYMENTS_WITHDRAWALS_AUTO_CONFIRM', FALSE),
    ],
];