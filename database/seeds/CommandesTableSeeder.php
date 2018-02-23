<?php

use Illuminate\Database\Seeder;

class CommandesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('commandes')->insert([
        [
          'num_commande' => '201701127_C',
          'dateDebut' => '2010-04-03 16:32:22',
          'concerne' => 'Hall principal Rolex',
          'num_devis' => '201701127_D',
          'num_offre' => '201701127_O',
          'user_id' => 1,
          'descriptionDevis' => 'Je suis du texte ... jsfjaklsdjdfkljsdjflasjfkljasdfjklasdjfhh',
          'status_id' => 1
        ],
        [
          'num_commande' => '20180211_C',
          'dateDebut' => '2015-07-03 20:20:22',
          'concerne' => 'Salle de gym Vevey',
          'num_devis' => '20180211_D',
          'num_offre' => '20180211_O',
          'user_id' => 1,
          'descriptionDevis' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur et ex ut est gravida accumsan. Curabitur dictum neque risus, sed facilisis nisl rutrum in. Sed sollicitudin cursus tristique. Proin cursus non quam sit amet hendrerit. Nunc sed elit nec est bibendum consectetur vitae ut diam. Praesent metus metus, mattis eu mollis vel, aliquam viverra dui. Ut eu finibus massa. Quisque consequat nisl eget condimentum bibendum. Sed sagittis sodales lacus, vel venenatis neque iaculis quis. Maecenas metus nulla, hendrerit vel massa nec, posuere ornare sem. Morbi nec scelerisque elit. Nam volutpat arcu at bibendum aliquet. Fusce mollis mi in lorem vulputate pretium.',
          'status_id' => 1
        ],
        [
          'num_commande' => '20180216_C',
          'dateDebut' => '2008-01-03 01:27:22',
          'concerne' => 'Arena Salle 3',
          'num_devis' => '20180216_D',
          'num_offre' => '20180216_O',
          'user_id' => 2,
          'descriptionDevis' => 'Test pour tableau de bord',
          'status_id' => 2
        ],
       ]);
    }
}
