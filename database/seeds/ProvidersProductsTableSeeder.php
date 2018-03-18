<?php

use Illuminate\Database\Seeder;

class ProvidersProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('providers_products_pivot')->insert([
              [
                  'provider_id' => 1,
                  'product_id' => 1
              ],
              [
                  'provider_id' => 1,
                  'product_id' => 2
              ],
              [
                  'provider_id' => 2,
                  'product_id' => 2
              ],
      ]);
        //
    }
}
