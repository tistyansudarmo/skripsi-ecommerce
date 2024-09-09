<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {

        $faker = Faker::create('id_ID'); // Menggunakan locale Indonesia

        // Daftar nama produk fashion wanita
        $productNames = [
            'Floral Print Dress', 'Maxi Skirt', 'Denim Jacket', 'Off-Shoulder Top', 'High-Waisted Jeans',
            'Bodycon Dress', 'Wrap Dress', 'Blazer', 'Crop Top', 'Palazzo Pants', 'Tunic', 'Peplum Top',
            'Leather Jacket', 'Sweater Dress', 'Cardigan', 'Pencil Skirt', 'Turtleneck Sweater', 'Kimono',
            'Bomber Jacket', 'Shift Dress', 'Bohemian Blouse', 'Puffer Coat', 'Ankle Boots', 'Wool Coat',
            'Jumpsuit', 'Lace Blouse', 'Chiffon Dress', 'Cargo Pants', 'Swing Coat', 'Button-Up Shirt'
        ];

        // Insert 100 dummy products
        for ($i = 0; $i < 100; $i++) {
            $productName = $faker->randomElement($productNames);
            $description = $this->generateProductDescription($productName);

            DB::table('products')->insert([
                'category_id' => $faker->numberBetween(1, 10), // Sesuaikan dengan jumlah kategori yang ada
                'name' => $productName, // Pilih nama dari daftar produk fashion wanita
                'description' => $description,
                'size' => $faker->randomElement(['S', 'M', 'L', 'XL', 'XXL']),
                'price' => $faker->numberBetween(50000, 375000),
                'image' => $faker->imageUrl(640, 480, 'animals', true)
            ]);
        }
    }

    /**
     * Menghasilkan deskripsi produk yang relevan dalam bahasa Indonesia
     *
     * @param string $productName
     * @return string
     */
    private function generateProductDescription($productName)
    {
        // Template deskripsi berdasarkan nama produk
        $descriptions = [
            'Floral Print Dress' => 'Gaun dengan motif bunga yang elegan, sempurna untuk acara santai atau semi-formal. Terbuat dari bahan berkualitas tinggi yang nyaman dipakai sepanjang hari.',
            'Maxi Skirt' => 'Rok panjang dengan desain simpel namun anggun. Cocok dipadukan dengan atasan apapun untuk tampilan yang feminin dan modis.',
            'Denim Jacket' => 'Jaket denim klasik yang tidak pernah lekang oleh waktu. Ideal untuk menambah kesan kasual namun tetap stylish.',
            'Off-Shoulder Top' => 'Atasan dengan potongan bahu terbuka yang menambah kesan seksi dan anggun. Nyaman dan pas untuk musim panas.',
            'High-Waisted Jeans' => 'Jeans dengan model pinggang tinggi yang dapat membentuk siluet tubuh lebih ramping. Cocok dipadukan dengan atasan apa saja.',
            // Tambahkan deskripsi lain sesuai kebutuhan...
        ];

        // Jika ada deskripsi khusus, gunakan itu; jika tidak, gunakan deskripsi umum
        return $descriptions[$productName] ?? 'Produk fashion wanita dengan desain modern dan material berkualitas tinggi. Cocok untuk berbagai acara dan suasana.';
    }

    /**
     * Mengambil URL gambar fashion wanita secara acak dari Unsplash
     *
     * @return string
     */

}
