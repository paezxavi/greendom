<?php

use Illuminate\Database\Seeder;

class CommandesProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('commandes_products_pivot')->insert([
                [
                    'commande_id' => 1,
                    'product_id' => 1
                ],
                [
                    'commande_id' => 2,
                    'product_id' => 1
                ],
                [
                    'commande_id' => 2,
                    'product_id' => 1
                ],
        ]);
    }
}
