<?php

use Illuminate\Database\Seeder;

class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('customers')->insert([
        [
           'nom' => 'Ramirez',
           'prenom' => 'Pedro',
           'adresse' => 'Rue de carouge',
           'contact' => 'pedro_1202@hotmail.com'
        ],

        [
          'nom' => 'Cacciapaglia',
          'prenom' => 'Karen',
          'adresse' => 'Rue des bonnasse',
          'contact' => 'kacci@gmail.com'
         ]
       ]);
    }
}
