<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Product;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 50; $i++) {

            $name = fake()->unique()->words(rand(2, 4), true);

            Product::create([
                'category_id' => rand(1, 5),
                'brand_id' => rand(1, 10),
                'name' => ucfirst($name),
                'slug' => Str::slug($name . '-' . fake()->unique()->numberBetween(1, 9999)),
                'description' => fake()->paragraph(3),
                'price' => fake()->randomFloat(2, 20, 500),
                'stock' => fake()->numberBetween(1, 100),
                'image' => fake()->imageUrl(640, 480, 'products', true),
                'status' => 'active',
            ]);
        }
    }
}
