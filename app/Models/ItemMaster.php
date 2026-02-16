<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemMaster extends Model
{
    use HasFactory;
    // Define fillable fields as per your table structure
    protected $fillable = [
        'itemname',
        'itemslug',
        'customertypeid',
    ];
}
