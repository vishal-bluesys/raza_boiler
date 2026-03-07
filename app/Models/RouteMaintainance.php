<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RouteMaintainance extends Model
{
    protected $table = 'route_maintanance';

    protected $fillable = [
        'vehicleid',
        'maintananceid',
        'maintanancetype',
        'routeid',
    ];

    public function maintanance()
    {
        return $this->belongsTo(Maintanance::class, 'maintananceid');
    }
}
