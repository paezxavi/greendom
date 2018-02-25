<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('image')->nullable();
            $table->string('nom')->nullable();
            $table->string('categorie')->nullable();
            $table->string('description')->nullable();
            $table->string('prixVente')->nullable();
            $table->string('reference')->nullable();
            $table->string('refSupplier')->nullable(); // ID_PROVIDER
            $table->string('prixAchat')->nullable();
            $table->string('private')->default(false);
            $table->string('feature')->nullable();
            //Si produit privé ou pas
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
