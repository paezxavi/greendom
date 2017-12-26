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
           'nom' => 'Rodriguez',
           'prenom' => 'Pedro',
           'adresse' => 'Rue de carouge',
           'contact' => 'pedro_1202@hotmail.com',
           'login' => 'pedro1202',
           'motdepasse' => 'pedro1',
           'company_id'=> '1'
        ],

        [
          'nom' => 'Cacciapaglia',
          'prenom' => 'Karen',
          'adresse' => 'Rue des bonnasse',
          'contact' => 'kacci@gmail.com',
          'login' => 'karen1213',
          'motdepasse' => 'frank',
          'company_id'=> '2'
         ]
       ]);
    }
}
