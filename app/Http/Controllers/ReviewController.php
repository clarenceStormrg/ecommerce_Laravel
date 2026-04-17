<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Review;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:2000',
        ]);

        $userId = Auth::id();
        $productId = $request->product_id;

        // 1) verificar si ya dejó reseña
        $alreadyReviewed = Review::where('user_id', $userId)
            ->where('product_id', $productId)
            ->exists();

        if ($alreadyReviewed) {
            return back()->with('error', 'Ya dejaste una reseña para este producto.');
        }

        // 2) verificar si compró el producto (paid)
        $hasBought = DB::table('order_items')
            ->join('orders', 'orders.id', '=', 'order_items.order_id')
            ->where('orders.user_id', $userId)
            ->where('orders.status', 'paid')
            ->where('order_items.product_id', $productId)
            ->exists();

        if (!$hasBought) {
            return back()->with('error', 'Debes comprar este producto antes de dejar una reseña.');
        }

        Review::create([
            'user_id' => $userId,
            'product_id' => $productId,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return back()->with('success', 'Reseña registrada correctamente.');
    }

    public function update(Request $request, Review $review)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:2000',
        ]);

        // solo el dueño puede editar
        if ($review->user_id !== Auth::id()) {
            abort(403);
        }

        $review->update([
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return back()->with('success', 'Reseña actualizada correctamente.');
    }
}
