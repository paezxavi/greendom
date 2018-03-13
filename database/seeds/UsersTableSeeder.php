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
          'password' => Hash::make('234'),
          'employee' => false,
          'company_id'=> '1'
        ],
        [
          'name' => 'deux',
          'forename' => 'ieme',
          'adresse' => 'Rue de Test',
          'contact' => 'skype.com',
          'email' => 'test2.bnbnb@hhgf.com',
          'password' => Hash::make('147'),
          'employee' => false,
          'company_id'=> '1'
        ],
        [
          'name' => 'Park',
          'forename' => 'John',
          'adresse' => 'Rue de Trois',
          'contact' => 'JeSuisSkype.com',
          'email' => 'Troisieme.bnbnb@hhgf.com',
          'password' => Hash::make('41236'),
          'employee' => false,
          'company_id'=> null
        ],
        [
          'name' => 'Cespedes',
          'forename' => 'Frank',
          'adresse' => 'Rue de Trois',
          'contact' => 'JeSuisSkype.com',
          'email' => 'frank_cespedes02@hotmail.com',
          'password' => Hash::make('41236'),
          'employee' => true,
          'company_id'=> null
        ],
        [
          'name' => 'Paez',
          'forename' => 'Xavie',
          'adresse' => 'Rue de Trois',
          'contact' => 'JeSuisSkype.com',
          'email' => 'paezxavie@gmail.com',
          'password' => Hash::make('41236'),
          'employee' => true,
          'company_id'=> null
        ],
        [
          'name' => 'Cacciapaglia',
          'forename' => 'Kevin',
          'adresse' => 'Rue de Trois',
          'contact' => 'JeSuisSkype.com',
          'email' => 'TestKev.bnbnb@hhgf.com',
          'password' => Hash::make('41236'),
          'employee' => false,
          'company_id'=> null
        ],
        [
          'name' => 'TestLog',
          'forename' => 'TestLog',
          'adresse' => 'Rue de Log',
          'contact' => 'JeSuisSkype.com',
          'email' => 'a@a',
          'password' => Hash::make('123'),
          'employee' => true,
          'company_id'=> null
        ],
       ]);
    }
}
