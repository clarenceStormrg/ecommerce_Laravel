<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Product;
use App\Models\User;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        // Seleccionamos solo usuarios customers
        $users = User::where('role', 'customer')->get();

        foreach ($users as $user) {

            // Cada usuario hará entre 1 y 3 órdenes
            $ordersCount = rand(1, 3);

            for ($i = 1; $i <= $ordersCount; $i++) {

                $order = Order::create([
                    'user_id' => $user->id,
                    'total_price' => 0,
                    'status' => fake()->randomElement(['pending', 'paid', 'shipped']),
                ]);

                $total = 0;

                // Cada orden tendrá entre 1 y 5 productos
                $itemsCount = rand(1, 5);

                $products = Product::inRandomOrder()->take($itemsCount)->get();

                foreach ($products as $product) {

                    $quantity = rand(1, 3);
                    $subtotal = $product->price * $quantity;

                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $product->id,
                        'quantity' => $quantity,
                        'price' => $product->price,
                        'subtotal' => $subtotal,
                    ]);

                    $total += $subtotal;
                }

                // Actualizar el total de la orden
                $order->update([
                    'total_price' => $total,
                ]);

                // Crear pago si la orden no está pending
                if ($order->status !== 'pending') {

                    Payment::create([
                        'order_id' => $order->id,
                        'payment_method' => fake()->randomElement(['paypal', 'stripe', 'bank_transfer']),
                        'amount' => $total,
                        'transaction_id' => fake()->uuid(),
                        'transaction_json' => [
                            'provider' => 'fake_payment',
                            'message' => 'Pago generado automáticamente'
                        ],
                        'status' => 'completed',
                    ]);
                }
            }
        }
    }
}
