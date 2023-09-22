<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'shipping_address',
        'total_order_value',
        'order_status'
    ];

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
