<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RouteStop extends Model
{
    use HasFactory;

    protected $table = 'route_stops';

    protected $fillable = [
        'routeid',
        'customerid',
        'itemid',
        'itemqty',
        'itemweight',
        'rateofsale',
        'created_by',
        'updated_by',
    ];
}
