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
                'provider_id' => 3,
                'product_id' => 1
              ],
              [
                  'provider_id' => 1,
                  'product_id' => 2
              ],
              [
                  'provider_id' => 2,
                  'product_id' => 3
              ],
              [
                'provider_id' => 2,
                'product_id' => 4
            ],
            [
                'provider_id' => 2,
                'product_id' => 5
            ],
            [
                'provider_id' => 2,
                'product_id' => 6
            ],
            [
                'provider_id' => 2,
                'product_id' => 7
            ],
            [
                'provider_id' => 2,
                'product_id' => 8
            ],
            [
                'provider_id' => 2,
                'product_id' => 9
            ],
            [
                'provider_id' => 2,
                'product_id' => 10
            ],
            [
                'provider_id' => 2,
                'product_id' => 11
            ],
            [
                'provider_id' => 2,
                'product_id' => 12
            ],
            [
                'provider_id' => 2,
                'product_id' => 13
            ],
            [
                'provider_id' => 2,
                'product_id' => 14
            ],
            [
                'provider_id' => 2,
                'product_id' => 15
            ],
            [
                'provider_id' => 2,
                'product_id' => 16
            ],
            [
                'provider_id' => 2,
                'product_id' => 17
            ],
            [
                'provider_id' => 2,
                'product_id' => 18
            ],
            [
                'provider_id' => 2,
                'product_id' => 19
            ],
            [
                'provider_id' => 2,
                'product_id' => 20
            ],
      ]);
        //
    }
}
