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
          'num_devis' => 1,
          'num_offre' => 1,
          'status_id' => 1,
          'user_id' => 1
        ],
       ]);
    }
}
