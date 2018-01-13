<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommandesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('commandes', function (Blueprint $table) {
         $table->increments('id');
         $table->String('num_commande');
         $table->String('num_devis');
         $table->String('num_offre');
         $table->integer('user_id')->unsigned()->index();
         $table->longText('descriptionDevis');
         $table->timestamps();

         $table->foreign('user_id')->references('id')->on("users")->onDelete('cascade')->onUpdate('cascade');
     });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      DB::statement('SET FOREIGN_KEY_CHECKS=0');
      Schema::dropIfExists('commandes');
      DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
