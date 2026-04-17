<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller
{
    public function show($id)
    {
        $product = Product::findOrFail($id);

        // Productos relacionados (random, excluyendo el actual)
        $relatedProducts = Product::where('id', '!=', $product->id)
            ->inRandomOrder()
            ->take(3)
            ->get();

        return view('product.show', compact('product', 'relatedProducts'));
    }

    public function quickView($id)
    {
        $product = Product::findOrFail($id);

        return response()->json([
            'id'             => $product->id,
            'name'           => $product->name,
            'description'    => $product->description,
            'price'          => $product->price,
            'discount_price' => $product->discount_price,
            'image'          => asset('storage/' . $product->image),
            'url'            => url('/product/' . $product->id),
        ]);
    }
}
