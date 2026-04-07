<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'rating',
        'comment'
    ];

    // Pertenece a un usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Pertenece a un producto
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
