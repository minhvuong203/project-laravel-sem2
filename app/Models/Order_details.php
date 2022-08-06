<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_details extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'order_details_id';
    protected $table = 'order_details';
}
