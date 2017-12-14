<?php

use Illuminate\Database\Seeder;

class CommandesProvidersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('commandes_providers_pivot')->insert([
                [
                    'commande_id' => 1,
                    'provider_id' => 1
                ],
                [
                    'commande_id' => 2,
                    'provider_id' => 1
                ],
                [
                    'commande_id' => 2,
                    'provider_id' => 1
                ],
        ]);
    }
}
