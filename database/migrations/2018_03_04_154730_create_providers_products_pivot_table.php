<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProvidersProductsPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('providers_products_pivot', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('provider_id')->unsigned()->index();
            $table->integer('product_id')->unsigned()->index();

            $table->foreign('provider_id')->references('id')->on("providers")->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('providers_products_pivot');
    }
}
