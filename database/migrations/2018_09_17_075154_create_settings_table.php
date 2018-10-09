<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sms_url');
            $table->string('sms_username');
            $table->string('sms_password');
            $table->string('emergency_email');
            $table->string('emergency_no');
            $table->string('fb_appid');
            $table->string('fb_appsecret');
            $table->integer('values_refresh_period');
            $table->float('paystack_percent');
            $table->float('transaction_percent');
            $table->float('transaction_percent_international');
            $table->decimal('minimum_trans_amount');
            $table->decimal('maximum_trans_fee');
            $table->decimal('max_trans_fee_international');
            $table->float('RAVE_local_fee');
            $table->float('RAVE_international_fee');
            $table->float('RAVE_max_fee_local');
            $table->float('RAVE_max_fee_international');
            $table->float('RAVE_extra_amt_local');
            $table->float('RAVE_extra_amt_international');
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
        Schema::dropIfExists('settings');
    }
}
