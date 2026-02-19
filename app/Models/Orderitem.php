<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orderitem extends Model
{
    use HasFactory;

    protected $table = 'orderitems';

    protected $fillable = [
        'orderid',
        'itemid',
        'itemweight',
        'status',
        'created_by',
        'updated_by',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'orderid');
    }
}
