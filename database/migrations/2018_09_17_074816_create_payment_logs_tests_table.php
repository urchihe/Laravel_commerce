<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentLogsTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_logs_tests', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyinteger('is_api');
            $table->string('merchantid');
            $table->string('email');
            $table->string('payer_name');
            $table->string('gateway');
            $table->string('transcode');
            $table->string('payment_type');
            $table->decimal('amount',25,2);
            $table->decimal('ActualAmount',25,2);
            $table->string('user_ipaddress');
            $table->decimal('pepperest_fee',15,2);
            $table->dateTime('payment_date');
            $table->string('description');
            $table->string('response_code');
            $table->mediumtext('response_msg');
            $table->string('trans_status');
            $table->string('payment_reference');
            $table->mediumtext('payment_description');
            $table->dateTime('insert_date');
            $table->dateTime('updated_date');
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
        Schema::dropIfExists('payment_logs_tests');
    }
}
