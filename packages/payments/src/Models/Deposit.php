<?php

namespace Packages\Payments\Models;

use App\Models\Account;
use App\Models\AccountTransaction;
use App\Models\Formatters\Formatter;
use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    use Formatter;

    const STATUS_PENDING   = 0;
    const STATUS_COMPLETED = 1;
    const STATUS_CANCELLED = 2;

    protected $formats = [
        'amount'            => 'decimal',
        'payment_amount'    => 'variableDecimal'
    ];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function transaction()
    {
        return $this->morphOne(AccountTransaction::class, 'transactionable');
    }
}
