<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'order_id';
    protected $table = 'order';
    public function order_items()
    {
        return $this->hasMany(Order_details::class, 'order_id', 'order_id');
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'users_id', 'users_id');
    }
    public function receiver()
    {
        return $this->belongsTo(Shipping::class, 'shipping_id', 'shipping_id');
    }
    public function payment()
    {
        return $this->belongsTo(User::class, 'payment_id', 'payment_id');
    }
}
