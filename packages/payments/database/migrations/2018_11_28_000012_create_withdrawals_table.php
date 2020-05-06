<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWithdrawalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('withdrawals', function (Blueprint $table) {
            // columns
            $table->increments('id');
            $table->integer('account_id')->unsigned();
            $table->decimal('amount', 20, 2); // amount in credits, e.g. 100.25 credits
            $table->string('wallet', 300);
            $table->string('payment_currency', 20);
            $table->string('comment', 1000)->nullable();
            $table->tinyInteger('status');
            $table->timestamps();
            // foreign keys
            $table->foreign('account_id')->references('id')->on('accounts')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('withdrawals');
    }
}
