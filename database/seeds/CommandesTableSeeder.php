<?php

use Illuminate\Database\Seeder;

class CommandesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('commandes')->insert([
        [
           'desc' => 'salut je veux cette ampoule',
           'statut' => 'Devis',
           'product_id' => '2',
        ],

        [
          'desc' => 'salut fdsagvfdbgfshbsfhbsgfe',
          'statut' => 'Devis',
          'product_id' => '1',
         ],
       ]);
    }
}
