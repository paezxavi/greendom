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
             ['nom' => 'Devis - En cours'],
             ['nom' => 'Devis - Envoyé'],
             ['nom' => 'Offre - En cours'],
             ['nom' => 'Offre - Validé'],
             ['nom' => 'Commande - En cours'],
             ['nom' => 'Commande - Terminé'],
        ]);
    }
}
