<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePepperestDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pepperest_details', function (Blueprint $table) {
            $table->increments('id');
            $table->string('companyname');
            $table->string('productname');
            $table->string('email');
            $table->string('phone');
            $table->string('address');
            $table->string('state');
            $table->string('country');
            $table->string('bank');
            $table->string('accountno');
            $table->string('subaccount_code');
            $table->string('recipient_code');
            $table->integer('Rave_transfer_id');
            $table->string('bankcode');
            $table->string('bankcountrycode');
            $table->string('accountname');
            $table->string('companylogo');
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
        Schema::dropIfExists('pepperest_details');
    }
}
