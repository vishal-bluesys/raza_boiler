<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RouteBuilder extends Model
{
    use HasFactory;

    protected $table = 'route_builder';

    protected $fillable = [
        'vehicleid',
        'driverid',
        'deliverydate',
        'status',
        'created_by',
        'updated_by',
    ];
}
