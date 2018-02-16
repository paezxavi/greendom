<?php

use Illuminate\Database\Seeder;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('status')->insert([
             ['nom' => 'Devis'],
             ['nom' => 'Offre'],
             ['nom' => 'Commande'],
             ['nom' => 'Terminé'],
        ]);
    }
}
