<?php

namespace Packages\Payments\Models\Sort\Frontend;

use App\Models\Sort\Sort;

class DepositSort extends Sort
{
    protected $sortableColumns = [
        'amount'            => 'amount',
        'payment_amount'    => 'payment_amount',
        'status'            => 'status',
        'created'           => 'created_at',
        'updated'           => 'updated_at'
    ];

    protected $defaultSort = 'created';
}