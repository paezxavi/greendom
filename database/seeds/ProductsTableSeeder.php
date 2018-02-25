<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'image' => 'http://greendom.eu/shop/img/p/1/5/SNT8B-XW.jpg',
                'nom' => "T8 compatibles",
                'categorie' => 'T8',
                'description' => 'Ceci est une grande ampoule utilisée pour les présentations',
                'prixVente' => '40',
                'reference' => 'GDT8B-06S-9W',
                'refSupplier' => 'SNT8B-06S-9W',
                'prixAchat' => '12'
            ],
            [
                'image' => 'http://greendom.eu/shop/img/p/1/5/SNT8B-XW.jpg',
                'nom' => "T8 compatibles",
                'categorie' => 'T8',
                'description' => 'Ceci est une description pour décrire des ampoules',
                'prixVente' => '50',
                'reference' => 'GDT8B-09S-14W',
                'refSupplier' => 'SNT8B-09S-14W',
                'prixAchat' => '15'
            ],
        ]);
    }
}
