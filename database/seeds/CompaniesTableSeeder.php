<?php

use Illuminate\Database\Seeder;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('companies')->insert([
        [
           'nom' => 'Rodriguez',
           'adresse' => 'Rue de la Jonction',
           'email' => 'rodriguez02@hotmail.com'
       ],
       [
           'nom' => 'Bla',
           'adresse' => "Rue companies",
           'email' => 'comp@mail.com'
       ]
      ]);
    }
}