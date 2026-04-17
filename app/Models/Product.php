<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'brand_id',
        'name',
        'slug',
        'description',
        'price',
        'discount_price',
        'stock',
        'image',
        'status',
    ];

    // Producto pertenece a una categoría
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Producto pertenece a una marca
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    // Producto puede estar en muchos order_items
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Producto puede estar en muchas listas de deseos
    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    // Producto puede tener muchas reseñas
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function finalPrice()
    {
        return $this->discount_price ?? $this->price;
    }

}
