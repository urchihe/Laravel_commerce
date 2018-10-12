<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('transcode');
            $table->integer('seller_id')->unsigned();
            $table->integer('buyer_id')->unsigned();
            $table->integer('currency_id')->unsigned();
            $table->integer('country_id')->unsigned();
            $table->string('confirm_token');
            $table->string('initiated_by');
            $table->string('transaction_type');
            $table->text('description');
            $table->decimal('amount',25,2);
            $table->dateTime('started_at');
            $table->dateTime('end_at');
            $table->string('fulfill_days');
            $table->dateTime('paid_at');
            $table->string('user_ipaddress');
            $table->string('transaction_status');
            $table->tinyinteger('confirmed_by_merchant');
            $table->dateTime('confirmed_at');
            $table->dateTime('stopped_at');
            $table->dateTime('insert_at');
            $table->boolean('is_released')->default(false);
            $table->boolean('is_stopped')->default(false);
            $table->boolean('is_refund')->default(false);
            $table->boolean('is_extended')->default(false);
            $table->tinyinteger('amountpaid');
            $table->dateTime('fufill_notice_at');
            $table->decimal('pepperest_fee',20,2);
            $table->decimal('paystack_fee',20,2);
            $table->decimal('RAVE_fee',20,2);
            $table->dateTime('stop_payment_at');
            $table->text('reason_for_stopping');
            $table->dateTime('refund_at');
             $table->dateTime('released_at');
            $table->text('reason_for_stop_refund');
            $table->dateTime('stop_refund_at');
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
        Schema::dropIfExists('transactions');
    }
}
