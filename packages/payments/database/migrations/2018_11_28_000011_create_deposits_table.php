<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepositsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deposits', function (Blueprint $table) {
            // columns
            $table->increments('id');
            $table->integer('account_id')->unsigned();
            $table->decimal('amount', 20, 2); // amount in credits, e.g. 100.25 credits
            $table->decimal('payment_amount', 26, 8); // amount in payment currency, e.g. 1.1215 BTC
            $table->string('payment_currency', 20);
            $table->tinyInteger('status');
            $table->string('external_id', 100); // external payment ID
            $table->timestamps();
            // foreign keys
            $table->foreign('account_id')->references('id')->on('accounts')->onUpdate('cascade')->onDelete('cascade');
            // indexes
            $table->index('external_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deposits');
    }
}
