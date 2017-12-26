<?php

use Illuminate\Database\Seeder;

class CustomersProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('customers_products_pivot')->insert([
              [
                  'customer_id' => 1,
                  'product_id' => 1,
                  'quantity' => 10
              ],
              [
                  'customer_id' => 2,
                  'product_id' => 1,
                  'quantity' => 12
              ],
              [
                  'customer_id' => 2,
                  'product_id' => 1,
                  'quantity' => 11
              ],
      ]);
    }
}
