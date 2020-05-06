<?php

namespace Packages\Payments\Models;

use App\Models\Account;
use App\Models\AccountTransaction;
use App\Models\Formatters\Formatter;
use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    use Formatter;

    const STATUS_CREATED     = 0;
    const STATUS_IN_PROGRESS = 1;
    const STATUS_COMPLETED   = 2;
    const STATUS_REJECTED    = 3;
    const STATUS_CANCELLED   = 4;

    protected $formats = [
        'amount' => 'decimal',
    ];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function transaction()
    {
        return $this->morphOne(AccountTransaction::class, 'transactionable');
    }

    /**
     * return withdrawal statuses
     *
     * @return static
     */
    public static function statuses()
    {
        $class = new \ReflectionClass(__CLASS__);
        $constants = collect($class->getConstants());
        return $constants->filter(function ($value, $key) {
            return strpos($key, 'STATUS_') !== FALSE;
        });
    }
}
