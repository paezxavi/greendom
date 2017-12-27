<?php

use Illuminate\Database\Seeder;

class CommandesCustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     DB::table('commandes_products_pivot')->insert([
      'start_date' => '01.01.2018',
      'end_date' => '31.01.2018',
      'commande_id' => '1',
      'customer_id' => '1'
      ]);
    }
}
