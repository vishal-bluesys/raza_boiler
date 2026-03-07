<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VehiclePurchase extends Model
{
    protected $table = 'vehicle_purchase';

    protected $fillable = [
        'vehicleid',
        'purchaseid',
        'driverid',
        'routeid',
    ];

    public function purchasemaster()
    {
        return $this->belongsTo(Purchasemaster::class, 'purchaseid');
    }
}
