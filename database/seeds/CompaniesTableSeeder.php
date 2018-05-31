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
           'name' => 'SIG',
           'address' => 'Rue de la Jonction 3',
           'email' => 'sig@geneve.com'
       ],
       [
           'name' => 'HEG',
           'address' => "Rue des HEG 24",
           'email' => 'comp@mail.com'
       ]
      ]);
    }
}
