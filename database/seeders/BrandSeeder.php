<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Brand;
use Illuminate\Support\Str;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
            'Samsung',
            'Apple',
            'Sony',
            'LG',
            'Nike',
            'Adidas',
            'Puma',
            'HP',
            'Lenovo',
            'Xiaomi'
        ];

        foreach ($brands as $name) {
            Brand::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'description' => 'Marca ' . $name
            ]);
        }
    }
}
