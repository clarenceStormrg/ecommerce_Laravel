<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlists = Wishlist::with('product')
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(18);

        return view('wishlist.index', [
            'wishlists' => $wishlists,
        ]);
    }

    public function store(Product $product)
    {
        $userId = Auth::id();

        $exists = Wishlist::where('user_id', $userId)
            ->where('product_id', $product->id)
            ->exists();

        if (! $exists) {
            Wishlist::create([
                'user_id'    => $userId,
                'product_id' => $product->id,
            ]);
        }

        $count = Wishlist::where('user_id', $userId)->count();

        return response()->json([
            'status' => 'added',
            'count'  => $count,
        ]);
    }

    public function destroy(Product $product)
    {
        $userId = Auth::id();

        Wishlist::where('user_id', $userId)
            ->where('product_id', $product->id)
            ->delete();

        $count = Wishlist::where('user_id', $userId)->count();

        return response()->json([
            'status' => 'removed',
            'count'  => $count,
        ]);
    }

    public function toggle(Product $product)
    {
        $userId = Auth::id();

        $wishlist = Wishlist::where('user_id', $userId)
            ->where('product_id', $product->id)
            ->first();

        if ($wishlist) {
            $wishlist->delete();

            return response()->json([
                'status' => 'removed',
            ]);
        }

        Wishlist::create([
            'user_id'    => $userId,
            'product_id' => $product->id,
        ]);

        return response()->json([
            'status' => 'added',
        ]);
    }
}
