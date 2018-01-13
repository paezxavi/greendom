<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('users')->insert([
        [
          'name' => 'toto',
          'forename' => 'tata',
          'adresse' => 'Rue de carouge',
          'contact' => 'skype.com',
          'email' => 'seb.bnbnb@hhgf.com',
          'password' => '234',
          'employee' => false,
          'company_id'=> '1'
        ],
        [
          'name' => 'deux',
          'forename' => 'ieme',
          'adresse' => 'Rue de Test',
          'contact' => 'skype.com',
          'email' => 'test2.bnbnb@hhgf.com',
          'password' => '147',
          'employee' => false,
          'company_id'=> '1'
        ],
       ]);
    }
}
