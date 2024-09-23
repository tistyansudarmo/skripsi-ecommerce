<?php

namespace Database\Seeders;

use App\Models\detail_transaction;
use App\Models\Transaction as ModelsTransaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Product;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $faker = Faker::create('id_ID');

        for ($i=0; $i < 200; $i++) {

            $courier = $faker->randomElement(['JNE', 'POS', 'TIKI']);
            if ($courier == 'JNE') {
                $shippingService = $faker->randomElement(['ECO', 'REG', 'JTR']);
            } elseif ($courier == 'POS') {
                $shippingService = $faker->randomElement(['Reguler', 'Kargo']);
            } elseif ($courier == 'TIKI') {
                $shippingService = $faker->randomElement(['REG', 'ECO']);
            }

            # code...
            ModelsTransaction::create([
                'customer_id' => 1,
                'order_id_midtrans' => uniqid(),
                'status' => 'Belum dibayar',
                'total_price' => $faker->numberBetween(50, 375) * 1000,
                'shipping_cost' => $faker->numberBetween(25, 85) * 1000,
                'courier' => $courier,
                'shipping_service' => $shippingService,
                'estimate' => $faker->randomElement(['3-4','1','2-3','4-6']),
                'date' => $faker->dateTimeBetween('-7 months', 'now')
            ]);
        }

            // Mengambil semua transaksi yang sudah ada
            $transactions = ModelsTransaction::all();

            foreach ($transactions as $transaction) {
                // Tentukan berapa banyak produk untuk transaksi ini (misalnya antara 1-5 produk)
                $productCount = $faker->numberBetween(1, 5);

                // Pilih produk acak untuk transaksi ini
                $products = Product::inRandomOrder()->take($productCount)->get();

                foreach ($products as $product) {
                    $quantity = $faker->numberBetween(1, 3); // Quantity produk
                    $price = $product->price; // Harga produk
                    $totalPrice = $price * $quantity; // Hitung total harga

                    // Membuat data dummy untuk detail transaksi
                    detail_transaction::create([
                        'transaction_id' => $transaction->id,
                        'product_id' => $product->id,
                        'quantity' => $quantity,
                        'price' => $price,
                        'total_price' => $totalPrice,
                        'date' => $faker->dateTimeBetween('-7 months', 'now'), // Tanggal transaksi acak dalam 6 bulan terakhir
                    ]);
                }
            }
        }
}
