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
          'num_demande' => '201701127_D',
          'num_offre' => '201701127_O',
          'user_id' => 1,
          'descriptionCommande' => 'Nous désirons mettre en lumière notre Hall principal afin de le rendre plus éblouissant. Ci-joint vous avez les photos de notre Hall avec les mensurations de la salle.',
          'status_id' => 1
        ],
        [
          'num_commande' => '20180211_C',
          'dateDebut' => '2015-07-03 20:20:22',
          'concerne' => 'Salle de gym Vevey',
          'num_demande' => '20180211_D',
          'num_offre' => '20180211_O',
          'user_id' => 1,
          'descriptionCommande' => 'Bonjour, Nous désirons remplacer nos lumières et voudrions avoir votre avis de professionnel afin de respecter les normes et l\'environnement.',
          'status_id' => 1
        ],
        [
          'num_commande' => '20180216_C',
          'dateDebut' => '2008-01-03 01:27:22',
          'concerne' => 'Arena Salle 3',
          'num_demande' => '20180216_D',
          'num_offre' => '20180216_O',
          'user_id' => 2,
          'descriptionCommande' => 'Bonjour, Nous désirons remplacer nos lumières et voudrions avoir votre avis de professionnel afin de respecter les normes et l\'environnement.',
          'status_id' => 2
        ],
        [
          'num_commande' => '20180217_C',
          'dateDebut' => '2008-01-03 01:27:24',
          'concerne' => 'CERN - Refactorisation',
          'num_demande' => '20180217_D',
          'num_offre' => '20180217_O',
          'user_id' => 2,
          'descriptionCommande' => 'Bonjour, Nous désirons remplacer nos lumières et voudrions avoir votre avis de professionnel afin de respecter les normes et l\'environnement.',
          'status_id' => 3
        ],
        [
          'num_commande' => '20160217_C',
          'dateDebut' => '2008-01-03 01:27:24',
          'concerne' => 'SIG - Aide',
          'num_demande' => '20160217_D',
          'num_offre' => '20160217_O',
          'user_id' => 2,
          'descriptionCommande' => 'Bonjour, Nous désirons remplacer nos lumières et voudrions avoir votre avis de professionnel afin de respecter les normes et l\'environnement.',
          'status_id' => 3
        ],
        [
          'num_commande' => '20120217_C',
          'dateDebut' => '2008-01-03 01:27:24',
          'concerne' => 'BeauRivage',
          'num_demande' => '20120217_D',
          'num_offre' => '20120217_O',
          'user_id' => 2,
          'descriptionCommande' => 'Bonjour, Nous désirons remplacer nos lumières et voudrions avoir votre avis de professionnel afin de respecter les normes et l\'environnement.',
          'status_id' => 3
        ],
       ]);
    }
}
