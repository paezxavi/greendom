<?php

use Illuminate\Database\Seeder;

class ProvidersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('providers')->insert([
        [
           'nom' => 'Lampe SA',
           'adresse' => 'rue des lampes',
           'email' => 'lampe@hotmail.com',
           'skype' => 'lampe_skype',
           'iban' => '1234 4564 2313 4564 4'
        ],

        [
          'nom' => 'Ampoule SA',
          'adresse' => 'rue des Ampoule',
          'email' => 'Ampoule@hotmail.com',
          'skype' => 'Ampoule_skype',
          'iban' => '54654654654654645 4'
         ],
       ]);
    }
}
