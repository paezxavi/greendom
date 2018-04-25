<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommandesProductsPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commandes_products_pivot', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('commande_id')->unsigned()->index();
            $table->integer('product_id')->unsigned()->index();
            $table->integer('quantity')->nullable();
            $table->double('prix')->nullable();
            $table->boolean('remiseBoolean')->nullable();
            $table->double('remisePrix')->nullable();
            $table->double('remisePourcent')->nullable();
            $table->double('total')->nullable();
            $table->string('fournisseur')->nullable();

            $table->foreign('commande_id')->references('id')->on("commandes")->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('commandes_products_pivot');
    }
}
