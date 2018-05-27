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
           'phone' => '0223232323',
           'skype' => 'lampe_skype',
           'iban' => '1234 4564 2313 4564 4'
        ],

        [
          'nom' => 'Ampoule SA',
          'adresse' => 'rue des Ampoule',
          'email' => 'Ampoule@hotmail.com',
          'phone' => '0223232323',
          'skype' => 'Ampoule_skype',
          'iban' => '54654654654654645 4'
         ],
         [
          'nom' => 'Kevin SA',
          'adresse' => 'rue Kevin',
          'email' => 'kevin@hotmail.com',
          'phone' => '0223232323',
          'skype' => 'Ampoule_skype',
          'iban' => '54654654654654645 4'
         ],
       ]);
    }
}
