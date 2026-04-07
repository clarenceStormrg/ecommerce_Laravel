<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'total_price',
        'status'
    ];

    // Una orden pertenece a un usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Una orden tiene muchos productos (order_items)
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Una orden tiene un pago
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
