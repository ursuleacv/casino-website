<?php

use Illuminate\Database\Seeder;
use App\Models\AccountTransaction;

// all seeder classes should have different names as they are in the same namespace
class AccountTransactionsClassNameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // it's important to update old Deposit model class name in the database
        AccountTransaction::where('transactionable_type', 'App\Models\Deposit')
            ->update(['transactionable_type' => 'Packages\Payments\Models\Deposit']);

        // it's important to update old Withdrawal model class name in the database
        AccountTransaction::where('transactionable_type', 'App\Models\Withdrawal')
            ->update(['transactionable_type' => 'Packages\Payments\Models\Withdrawal']);
    }
}
