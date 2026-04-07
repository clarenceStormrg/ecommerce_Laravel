<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\ShippingAddress;
use App\Models\User;

class ShippingAddressSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::where('role', 'customer')->get();

        foreach ($users as $user) {

            // Cada usuario tendrá entre 1 y 3 direcciones
            $count = rand(1, 3);

            for ($i = 1; $i <= $count; $i++) {
                ShippingAddress::create([
                    'user_id' => $user->id,
                    'address' => fake()->streetAddress(),
                    'city' => fake()->city(),
                    'state' => fake()->state(),
                    'zip_code' => fake()->postcode(),
                    'country' => fake()->country(),
                ]);
            }
        }
    }
}
