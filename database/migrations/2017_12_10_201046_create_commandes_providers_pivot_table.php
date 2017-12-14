<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommandesProvidersPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commandes_providers_pivot', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('commande_id')->unsigned()->index();
            $table->integer('provider_id')->unsigned()->index();

            $table->foreign('commande_id')->references('id')->on("commandes")->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('provider_id')->references('id')->on("providers")->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('commandes_providers_pivot');
    }
}
