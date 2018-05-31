<?php

use Illuminate\Database\Seeder;

class ProvidersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('providers')->insert([
        [
           'nom' => 'Lampe SA',
           'adresse' => 'Rue des lampes 52',
           'email' => 'lampe@hotmail.com',
           'phone' => '0223232323',
           'skype' => 'lampe_skype',
           'iban' => '1234 4564 2313 4564 4'
        ],

        [
          'nom' => 'Ampoule SA',
          'adresse' => 'Rue des Ampoule 13',
          'email' => 'Ampoule@hotmail.com',
          'phone' => '0223232323',
          'skype' => 'Ampoule_skype',
          'iban' => '54654654654654645 4'
         ],
         [
          'nom' => 'SIG',
          'adresse' => 'Rue de la tambourine 24',
          'email' => 'sig@geneve.com',
          'phone' => '0223232323',
          'skype' => 'Ampoule_skype',
          'iban' => '54654654654654645 4'
         ],
         [
          'nom' => 'LumiereEclatante SA',
          'adresse' => 'Rue des lumière 22',
          'email' => 'lumiereeclatante@geneve.com',
          'phone' => '0223232323',
          'skype' => 'Ampoule_skype',
          'iban' => '54654654654654645 4'
         ],
         [
          'nom' => 'Etoile D\'à Côté',
          'adresse' => 'Rue de la Servette 4',
          'email' => 'etoile@hgeneve.com',
          'phone' => '0223232323',
          'skype' => 'Ampoule_skype',
          'iban' => '54654654654654645 4'
         ],
         [
          'nom' => 'Brillance SA',
          'adresse' => 'Rue de Carouge 8',
          'email' => 'brillance@geneve.com',
          'phone' => '0223232323',
          'skype' => 'Ampoule_skype',
          'iban' => '54654654654654645 4'
         ],
       ]);
    }
}
