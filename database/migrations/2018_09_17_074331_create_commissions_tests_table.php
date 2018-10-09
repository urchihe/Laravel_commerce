<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommissionsTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commissions_tests', function (Blueprint $table) {
            $table->increments('id');
            $table->string('transcode');
            $table->string('merchant_email');
            $table->string('customer_email');
            $table->decimal('amount', 25,2);
            $table->integer('transfer_batch_id');
            $table->decimal('rave_fee', 15,2);
            $table->decimal('transfer_fee', 25,2);
            $table->decimal('pepperest_fee', 25,2);
            $table->decimal('paystack_fee', 25,2);
            $table->tinyinteger('merchant_pay_status');
            $table->dateTime('payment_date');
            $table->dateTime('merchant_pay_date');
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
        Schema::dropIfExists('commissions_tests');
    }
}
