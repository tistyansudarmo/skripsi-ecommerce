<?php

namespace Database\Seeders;

use App\Models\Category as ModelsCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Category extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $name = [
            'Dress','Top','Jumpsuit','Oneset','Outer','Pants','Blouse','T-Shirt','Hotpants','Skirt','Longpants','Sweater','Tanktop'
        ];

        foreach ($name as $category) {
            # code...
            ModelsCategory::create([
                'name' => $category
            ]);
        }
    }
}
