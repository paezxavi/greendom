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
             ['nom' => 'Demande - En cours'],
             ['nom' => 'Demande - Envoyée'],
             ['nom' => 'Offre - En cours'],
             ['nom' => 'Offre - Envoyée fournisseur'],
             ['nom' => 'Offre - Envoyée Client'],
             ['nom' => 'Commande - En cours'],
             ['nom' => 'Commande - Reçue'],
             ['nom' => 'Commande - Terminée'],
             ['nom' => 'Abandonnée'],
        ]);
    }
}
