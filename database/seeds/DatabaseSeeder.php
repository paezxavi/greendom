<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ProductsTableSeeder::class);
        $this->call(CustomersTableSeeder::class);
        $this->call(CommandesTableSeeder::class);
        $this->call(ProvidersTableSeeder::class);
        $this->call(CommandesProductsTableSeeder::class);
        $this->call(CommandesProvidersTableSeeder::class);
    }
}
