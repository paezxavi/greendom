<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommandesCustomersPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commandes_customers_pivot', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->integer('commande_id')->unsigned()->index();
            $table->integer('customer_id')->unsigned()->index();

            $table->foreign('commande_id')->references('id')->on("commandes")->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('customer_id')->references('id')->on("customers")->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('commandes_customers_pivot');
    }
}
