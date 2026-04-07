<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@ecommerce.com',
            'password' => Hash::make('admin123'),
            'phone' => '999999999',
            'role' => 'admin',
            'address' => 'Dirección Admin',
        ]);

        User::factory(40)->create([
            'role' => 'customer'
        ]);
    }
}
