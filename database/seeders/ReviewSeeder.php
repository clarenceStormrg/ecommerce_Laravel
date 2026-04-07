<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Product;
use App\Models\Review;
use App\Models\User;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        $products = Product::all();
        $users = User::where('role', 'customer')->get();

        foreach ($products as $product) {

            // Cada producto tendrá mínimo 10 reseñas
            for ($i = 1; $i <= 10; $i++) {

                $user = $users->random();

                Review::create([
                    'user_id' => $user->id,
                    'product_id' => $product->id,
                    'rating' => rand(1, 5),
                    'comment' => fake()->sentence(12),
                ]);
            }
        }
    }
}
