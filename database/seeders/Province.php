<?php

namespace Database\Seeders;

use App\Models\Province as ModelsProvince;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;


class Province extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $provinsi = Http::withHeaders([
            'key' => '96abfca08a93e9256ddbe3297040d191'
        ])->get('https://api.rajaongkir.com/starter/province');
        $province = $provinsi['rajaongkir']['results'];

        foreach ($province as $getProvince) {
            ModelsProvince::create([
                'name' => $getProvince['province']
            ]);
        }

    }
}
