<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        Customer::create([
            'province_id' => '31',
            'city_id' => '267',
            'name' => 'tistyan sudarmo',
            'email' => 'tistyan@gmail.com',
            'no_telepon' => '089631463640',
            'address_street' => 'Jln Bethesda 4 no 5',
            'postal_code' => '95114',
            'google_id' => 123456789
        ]);

        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin12345678'),
            'no_telepon' => '089631463640',
            'address_street' => 'Jln Bethesda 4 no 5',
            'city_id' => '267',
            'province_id' => '31',
            'postal_code' => '95114'
        ]);
    }
}
