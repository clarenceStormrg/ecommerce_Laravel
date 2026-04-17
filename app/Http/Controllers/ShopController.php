<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
    public function show($id)
    {
        $product = Product::with('brand')->findOrFail($id);

        // Productos recomendados (por ahora aleatorios)
        $recommendedProducts = Product::where('id', '!=', $product->id)
            ->inRandomOrder()
            ->take(6)
            ->get();

        // ===== REVIEWS =====
        $hasBought = false;
        $userReview = null;

        if (Auth::check()) {

            $userReview = Review::where('user_id', Auth::id())
                ->where('product_id', $product->id)
                ->first();

            $hasBought = DB::table('order_items')
                ->join('orders', 'orders.id', '=', 'order_items.order_id')
                ->where('orders.user_id', Auth::id())
                ->where('orders.status', 'paid')
                ->where('order_items.product_id', $product->id)
                ->exists();
        }

        $reviews = Review::with('user')
            ->where('product_id', $product->id)
            ->latest()
            ->get();

        $totalReviews = $reviews->count();
        $averageRating = $totalReviews > 0 ? round($reviews->avg('rating'), 2) : 0;

        return view('product.show', compact(
            'product',
            'recommendedProducts',
            'hasBought',
            'userReview',
            'reviews',
            'totalReviews',
            'averageRating'
        ));
    }
}
