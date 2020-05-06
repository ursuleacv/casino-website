<?php

namespace Packages\Payments\Models\Sort\Backend;

use App\Models\Sort\Sort;

class DepositSort extends Sort
{
    protected $sortableColumns = [
        'id'                => 'id',
        'amount'            => 'amount',
        'payment_amount'    => 'payment_amount',
        'status'            => 'status',
        'created'           => 'created_at',
        'updated'           => 'updated_at'
    ];
}