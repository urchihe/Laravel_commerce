<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions_tests', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('posting_date');
            $table->string('transcode');
            $table->string('tempcode');
            $table->string('customer_email');
            $table->string('merchant_email');
            $table->string('merchantid');
            $table->text('description');
            $table->decimal('amount',25,2);
            $table->string('country');
            $table->string('currency');
            $table->dateTime('startdate');
            $table->dateTime('enddate');
            $table->string('fulfill_days');
            $table->dateTime('payment_date');
            $table->string('payment_status');
            $table->tinyinteger('confirmed_by_merchant')->default(0);;
            $table->dateTime('confirmed_date');
            $table->dateTime('cancelled_date');
            $table->dateTime('insert_date');
            $table->tinyinteger('amountpaid')->default(0);;
            $table->dateTime('fufill_notice_date');
            $table->decimal('pepperest_fee',20,2);
            $table->decimal('paystack_fee',20,2);
            $table->decimal('RAVE_fee',20,2);
            $table->dateTime('stop_payment_date');
            $table->text('reason_for_stopping');
            $table->dateTime('refund_date');
            $table->text('reason_for_stop_refund');
            $table->dateTime('stop_refund_date');
            $table->dateTime('arbitration_request_date');
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
        Schema::dropIfExists('transactions_tests');
    }
}
