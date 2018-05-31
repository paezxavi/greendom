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
          'name' => 'Cespedes',
          'forename' => 'Frank',
          'address' => 'Rue de la Servette 32',
          'phone' => '022202020',
          'contact' => 'frankServette',
          'email' => 'frank_cespedes02@hotmail.com',
          'password' => Hash::make('41236'),
          'employee' => true,
          'company_id'=> null
        ],
        [
          'name' => 'Paez',
          'forename' => 'Xavie',
          'address' => 'Rue de Carouge 12',
          'phone' => '022202020',
          'contact' => 'xavieCarouge',
          'email' => 'paezxavie@gmail.com',
          'password' => Hash::make('41236'),
          'employee' => true,
          'company_id'=> null
        ],
        [
          'name' => 'Cacciapaglia',
          'forename' => 'Kevin',
          'address' => 'Rue des Esserts 2',
          'phone' => '022202020',
          'contact' => 'kevinEssert',
          'email' => 'kecacci@hotmail.com',
          'password' => Hash::make('41236'),
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
          'company_id'=> 2
        ],
       ]);
    }
}
