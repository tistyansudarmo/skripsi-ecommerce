<?php

namespace Database\Seeders;

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
            // 'Floral Print Dress', 'Maxi Skirt', 'Denim Jacket', 'Off-Shoulder Top', 'High-Waisted Jeans',
            // 'Bodycon Dress', 'Wrap Dress', 'Blazer', 'Crop Top', 'Palazzo Pants', 'Tunic', 'Peplum Top',
            // 'Leather Jacket', 'Sweater Dress', 'Cardigan',
            'Pencil Skirt', 'Turtleneck Sweater', 'Kimono',
            'Bomber Jacket', 'Shift Dress', 'Bohemian Blouse', 'Puffer Coat', 'Ankle Boots', 'Wool Coat',
            'Jumpsuit', 'Lace Blouse', 'Chiffon Dress', 'Cargo Pants', 'Swing Coat', 'Button-Up Shirt'
        ];

        // Insert 100 dummy products
        foreach ($productNames as $productName) {
            $description = $this->generateProductDescription($productName);

            DB::table('products')->insert([
                'category_id' => $faker->numberBetween(1, 13), // Sesuaikan dengan jumlah kategori yang ada
                'name' => $productName, // Pilih nama dari daftar produk fashion wanita
                'description' => $description,
                'size' => $faker->randomElement(['S', 'M', 'L', 'XL', 'XXL']),
                'price' => $faker->numberBetween(50, 375) * 1000,
                'weight' => $faker->numberBetween(100, 350),
                'image' => $faker->imageUrl(640, 480, 'fashion', true)
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
            'Bodycon Dress' => 'Gaun ketat yang menonjolkan lekuk tubuh, ideal untuk acara pesta atau malam spesial.',
            'Wrap Dress' => 'Gaun dengan model lilit yang memberikan kesan elegan dan fleksibel, cocok untuk berbagai tipe tubuh.',
            'Blazer' => 'Blazer formal yang pas untuk tampilan profesional, namun tetap nyaman dan modis.',
            'Crop Top' => 'Atasan pendek yang trendi dan cocok dipadukan dengan high-waisted jeans atau rok.',
            'Palazzo Pants' => 'Celana dengan potongan longgar yang nyaman dan elegan, memberikan kesan modis dan chic.',
            'Tunic' => 'Tunik longgar yang nyaman dan pas untuk dikenakan sehari-hari. Cocok untuk gaya kasual.',
            'Peplum Top' => 'Atasan dengan detail lipit di pinggang yang memberikan siluet feminin dan anggun.',
            'Leather Jacket' => 'Jaket kulit klasik yang memberikan tampilan edgy dan stylish, cocok untuk berbagai suasana.',
            'Sweater Dress' => 'Gaun sweater yang nyaman untuk dipakai di musim dingin, memberikan kehangatan dan gaya sekaligus.',
            'Cardigan' => 'Cardigan lembut yang mudah dipadukan dengan berbagai pakaian, memberikan kehangatan dan tampilan kasual.',
            'Pencil Skirt' => 'Rok pensil dengan potongan yang pas di tubuh, ideal untuk suasana formal atau profesional.',
            'Turtleneck Sweater' => 'Sweater dengan kerah tinggi yang memberikan tampilan elegan dan kehangatan di musim dingin.',
            'Kimono' => 'Outer kimono yang longgar dan ringan, memberikan tampilan kasual namun elegan.',
            'Bomber Jacket' => 'Jaket bomber yang trendi dan sporty, cocok untuk tampilan kasual yang santai.',
            'Shift Dress' => 'Gaun dengan potongan longgar yang memberikan kenyamanan maksimal dan tampilan minimalis.',
            'Bohemian Blouse' => 'Blus dengan sentuhan bohemian yang unik, menambah kesan santai namun tetap modis.',
            'Puffer Coat' => 'Mantel tebal yang memberikan kehangatan maksimal di musim dingin tanpa mengorbankan gaya.',
            'Ankle Boots' => 'Sepatu boot setinggi pergelangan kaki yang cocok untuk dipadukan dengan berbagai outfit musim gugur.',
            'Wool Coat' => 'Mantel wol yang klasik dan elegan, memberikan kehangatan serta gaya yang tak lekang oleh waktu.',
            'Jumpsuit' => 'Jumpsuit yang modern dan praktis, cocok untuk tampilan yang effortless namun tetap stylish.',
            'Lace Blouse' => 'Blus renda yang anggun, menambah kesan feminin dan cocok untuk acara formal atau semi-formal.',
            'Chiffon Dress' => 'Gaun chiffon ringan yang memberikan kesan elegan dan anggun, sempurna untuk acara pesta.',
            'Cargo Pants' => 'Celana cargo yang praktis dengan banyak kantong, cocok untuk gaya kasual dan aktif.',
            'Swing Coat' => 'Mantel dengan potongan A-line yang modis dan memberikan kesan elegan dan dramatis.',
            'Button-Up Shirt' => 'Kemeja dengan kancing depan yang klasik, pas untuk tampilan formal maupun kasual.'

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
