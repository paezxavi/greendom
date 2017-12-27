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
         $this->call(UsersTableSeeder::class);
         $this->call(ProductsTableSeeder::class);
         $this->call(CompaniesTableSeeder::class);
         $this->call(ProvidersTableSeeder::class);
         $this->call(StatusTableSeeder::class);
         $this->call(CommandesTableSeeder::class);
         $this->call(CommandesProductsTableSeeder::class);
         $this->call(CommandesProvidersTableSeeder::class);
         $this->call(CustomersTableSeeder::class);
         $this->call(CustomersProductsTableSeeder::class);
         $this->call(GreendomTableSeeder::class);
         $this->call(CommandesCustomersTableSeeder::class);
    }
}
