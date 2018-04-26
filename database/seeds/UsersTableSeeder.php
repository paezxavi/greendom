<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
          'address' => 'Rue de carouge',
          'phone' => '022202020',
          'contact' => 'skype.com',
          'email' => 'seb.bnbnb@hhgf.com',
          'password' => Hash::make('234'),
          'employee' => false,
          'company_id'=> '1'
        ],
        [
          'name' => 'deux',
          'forename' => 'ieme',
          'address' => 'Rue de Test',
          'phone' => '022202020',
          'contact' => 'skype.com',
          'email' => 'test2.bnbnb@hhgf.com',
          'password' => Hash::make('147'),
          'employee' => false,
          'company_id'=> '1'
        ],
        [
          'name' => 'Park',
          'forename' => 'John',
          'address' => 'Rue de Trois',
          'phone' => '022202020',
          'contact' => 'JeSuisSkype.com',
          'email' => 'Troisieme.bnbnb@hhgf.com',
          'password' => Hash::make('41236'),
          'employee' => false,
          'company_id'=> null
        ],
        [
          'name' => 'Cespedes',
          'forename' => 'Frank',
          'address' => 'Rue de Trois',
          'phone' => '022202020',
          'contact' => 'JeSuisSkype.com',
          'email' => 'frank_cespedes02@hotmail.com',
          'password' => Hash::make('41236'),
          'employee' => false,
          'company_id'=> null
        ],
        [
          'name' => 'Paez',
          'forename' => 'Xavie',
          'address' => 'Rue de Trois',
          'phone' => '022202020',
          'contact' => 'JeSuisSkype.com',
          'email' => 'paezxavie@gmail.com',
          'password' => Hash::make('41236'),
          'employee' => true,
          'company_id'=> null
        ],
        [
          'name' => 'Cacciapaglia',
          'forename' => 'Kevin',
          'address' => 'Rue de Trois',
          'phone' => '022202020',
          'contact' => 'JeSuisSkype.com',
          'email' => 'TestKev.bnbnb@hhgf.com',
          'password' => Hash::make('41236'),
          'employee' => false,
          'company_id'=> null
        ],
        [
          'name' => 'TestLog',
          'forename' => 'TestLog',
          'address' => 'Rue de Log',
          'phone' => '022202020',
          'contact' => 'JeSuisSkype.com',
          'email' => 'a@a',
          'password' => Hash::make('123'),
          'employee' => true,
          'company_id'=> null
        ],
        [
          'name' => 'Nicollin',
          'forename' => 'Sébastien',
          'address' => 'Rue de la tambourine 12',
          'phone' => '022202020',
          'contact' => 'Skype.com',
          'email' => 'seb.nicollin@gmail.com',
          'password' => Hash::make('seb1212'),
          'employee' => true,
          'company_id'=> null
        ],
       ]);
    }
}
