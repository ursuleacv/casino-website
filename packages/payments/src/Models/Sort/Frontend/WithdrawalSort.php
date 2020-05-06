<?php

namespace Packages\Payments\Models\Sort\Frontend;

use App\Models\Sort\Sort;

class WithdrawalSort extends Sort
{
    protected $sortableColumns = [
        'amount'                => 'amount',
        'wallet'                => 'wallet',
        'payment_currency'      => 'payment_currency',
        'status'                => 'status',
        'created'               => 'created_at',
        'updated'               => 'updated_at'
    ];

    protected $defaultSort = 'created';
}