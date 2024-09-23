<?php

namespace Database\Seeders;

use App\Models\Cities as ModelsCities;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class Cities extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $cities = Http::withHeaders([
            'key' => '96abfca08a93e9256ddbe3297040d191'
        ])->get('https://api.rajaongkir.com/starter/city');
        $city = $cities['rajaongkir']['results'];

        foreach ($city as $getCity) {
            # code...
            ModelsCities::create([
                'province_id' => $getCity['province_id'],
                'name' => $getCity['city_name']
            ]);
        }
    }
}
