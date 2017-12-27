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
     DB::table('commandes_customers_pivot')->insert([
      'start_date' => '2018-01-01 16:32:22',
      'end_date' => '2018-01-31 16:32:22',
      'commande_id' => 1,
      'customer_id' => 1
      ]);
    }
}
