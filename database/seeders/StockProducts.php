<?php

namespace Database\Seeders;

use App\Models\Stock;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class StockProducts extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        //
        for ($i = 1; $i <= 30; $i++) {
            Stock::create([
                'product_id' => $i, // Menggunakan nomor produk sesuai perulangan
                'quantity' => $faker->numberBetween(10, 20)
            ]);
        }
    }
}
