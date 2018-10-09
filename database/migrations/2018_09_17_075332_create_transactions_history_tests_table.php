<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsHistoryTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions_history_tests', function (Blueprint $table) {
            $table->increments('id');
            $table->string('transcode');
            $table->string('customer_email');
            $table->string('merchant_email');
            $table->string('trans_status');
            $table->dateTime('status_update_date');
            $table->string('updatedby');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions_history_tests');
    }
}
