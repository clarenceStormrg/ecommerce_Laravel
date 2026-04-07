<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Product;
use App\Models\User;
use App\Models\Wishlist;

class WishlistSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::where('role', 'customer')->get();

        foreach ($users as $user) {

            // Cada usuario tendrá entre 5 y 10 productos en wishlist
            $count = rand(5, 10);

            $products = Product::inRandomOrder()->take($count)->get();

            foreach ($products as $product) {
                Wishlist::create([
                    'user_id' => $user->id,
                    'product_id' => $product->id,
                ]);
            }
        }
    }
}
