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
           'name' => 'Rodriguez',
           'address' => 'Rue de la Jonction',
           'email' => 'rodriguez02@hotmail.com'
       ],
       [
           'name' => 'Bla',
           'address' => "Rue companies",
           'email' => 'comp@mail.com'
       ]
      ]);
    }
}
