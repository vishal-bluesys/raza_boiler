<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'customerid',
        'orderdate',
        'orderstatus',
        'created_by',
        'updated_by',
    ];

    public function items()
    {
        return $this->hasMany(Orderitem::class, 'orderid');
    }
}
