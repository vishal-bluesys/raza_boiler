<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleMaster extends Model
{
    use HasFactory;
    protected $table = 'vehiclemaster';
    // Define fillable fields as per your table structure
    protected $fillable = [
        'vehicletype',
        'vehicalid',
        'rcnumber',
        'vehicalmodel',
        'ownername',
        'owneraddress',
        'dateofjoining',
        'contactpersonname',
        'contactperson_number',
        'created_by',
        'updated_by',
    ];
}
