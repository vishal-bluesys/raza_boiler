<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemMaster extends Model
{
    use HasFactory;
    protected $table = 'item_master';
    // Define fillable fields as per your table structure
    protected $fillable = [
        'itemname',
        'itemslug',
        'customertypeid',
    ];
}
