<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProdukTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $products = ["Sepatu Nike", "Polo Ga", "Topi Br56", "Jaket Keren", "Jaket Parasut", "Tshirt 67"];

        foreach ($products as $product) {
            DB::table('produk')->insert([
	            'supplier_id' => rand(1,10),
	            'nama' => $product,
	            'harga_jual' => rand(100,800) * 1000,
	            'status' => $faker->boolean,
	            'created_at' => now(),
	            'updated_at' => now(),
	        ]);
        }
    }
}
