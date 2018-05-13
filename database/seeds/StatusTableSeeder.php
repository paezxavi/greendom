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
             ['nom' => 'Demande - Envoyé'],
             ['nom' => 'Offre - En cours'],
             ['nom' => 'Offre - Envoyé fournisseur'],
             ['nom' => 'Offre - Envoyé Client'],
             ['nom' => 'Commande - En cours'],
             ['nom' => 'Commande - Reçu'],
             ['nom' => 'Commande - Terminé'],
        ]);
    }
}
