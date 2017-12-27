<?php

use Illuminate\Database\Seeder;

class GreendomTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('greendom')->insert([
         [
            'nom' => 'GreenDom',
            'adresse' => 'Rue de Genève 6, 1225 Chêne-Bourg, SUISSE',
            'email' => 'info@greendom.eu',
            'skype' => 'TBD',
            'twitter' => '@Greendom',
            'telephone' => '+41 (0) 22 556 0259',
            'fax' => '+41 (0) 22 556 0258'
         ],
       ]);
    }
}
