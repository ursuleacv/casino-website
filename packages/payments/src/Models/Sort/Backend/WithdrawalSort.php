<?php

namespace Packages\Payments\Models\Sort\Backend;

use App\Models\Sort\Sort;

class WithdrawalSort extends Sort
{
    protected $sortableColumns = [
        'id'                    => 'id',
        'amount'                => 'amount',
        'payment_currency'      => 'payment_currency',
        'status'                => 'status',
        'created'               => 'created_at',
        'updated'               => 'updated_at'
    ];
}