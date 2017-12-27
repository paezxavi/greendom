<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersProductsPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers_products_pivot', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('customer_id')->unsigned()->index();
            $table->integer('product_id')->unsigned()->index();
            $table->integer('quantity')->nullable();

            $table->foreign('customer_id')->references('id')->on("customers")->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('product_id')->references('id')->on("products")->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('customers_products_pivot');
    }
}
