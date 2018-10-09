<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerproductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customerproducts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('seller_id')->unsigned();
            $table->integer('currency_id')->unsigned();
            $table->string('productname');
            $table->string('description');
            $table->string('productid');
            $table->decimal('price', 25,2);
            $table->string('link');
            $table->mediumtext('html_link');
            $table->string('image_url');
            $table->dateTime('payment_at');
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
        Schema::dropIfExists('customerproducts');
    }
}
