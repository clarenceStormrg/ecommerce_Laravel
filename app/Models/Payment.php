<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'order_id',
        'payment_method',
        'amount',
        'transaction_id',
        'transaction_json',
        'status'
    ];

    protected $casts = [
        'transaction_json' => 'array',
    ];

    // Pertenece a una orden
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
