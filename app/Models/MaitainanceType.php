<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaitainanceType extends Model
{
    use HasFactory;
    protected $table = 'maitainancetype';
    // Define fillable fields as per your table structure
    protected $fillable = [
        'maintanancetype',
    ];
}
