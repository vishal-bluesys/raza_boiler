<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleTypeMaster extends Model
{
    use HasFactory;
    protected $table = 'vehicletypemaster';
    // Define fillable fields as per your table structure
    protected $fillable = [
        'vehicletype',
    ];
}
