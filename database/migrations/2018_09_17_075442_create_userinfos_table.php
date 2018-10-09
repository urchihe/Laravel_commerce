<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserinfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('userinfos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fullname');
            $table->string('password');
            $table->string('username');
            $table->tinyinteger('accountstatus');
            $table->dateTime('datecreated');
            $table->string('role');
            $table->string('email');
            $table->string('phone');
            $table->tinyinteger('AddItem')->default(0);;
            $table->tinyinteger('EditItem')->default(0);;
            $table->tinyinteger('DeleteItem')->default(0);;
            $table->tinyinteger('ClearLogFiles')->default(0);;
            $table->tinyinteger('ViewLogReports')->default(0);;
            $table->tinyinteger('ViewReports')->default(0);;
            $table->tinyinteger('CreateUsers')->default(0);;
            $table->tinyinteger('SetParameters')->default(0);;
            $table->tinyinteger('ResolvePaymentIssues')->default(0);;
            $table->tinyinteger('MakePayment')->default(0);;
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
        Schema::dropIfExists('userinfos');
    }
}
