<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 50; $i++) {

            $name = fake()->unique()->words(rand(2, 4), true);

            $price = fake()->randomFloat(2, 20, 500);

            // 30% de probabilidad de tener descuento
            $discountPrice = null;
            if (fake()->boolean(30)) {
                $discountPrice = round($price * fake()->randomFloat(2, 0.70, 0.95), 2);
            }

            Product::create([
                'category_id' => rand(1, 5),
                'brand_id' => rand(1, 10),
                'name' => ucfirst($name),
                'slug' => Str::slug($name . '-' . fake()->unique()->numberBetween(1, 9999)),
                'description' => fake()->paragraph(3),
                'price' => $price,
                'discount_price' => $discountPrice,
                'stock' => fake()->numberBetween(1, 100),

                // Imagen desde storage/app/public/products
                'image' => "products/p{$i}.png",

                'status' => 'active',
            ]);
        }
    }
}
