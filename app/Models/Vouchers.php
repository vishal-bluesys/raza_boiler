<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vouchers extends Model
{
    use HasFactory;
    // Define fillable fields as per your table structure
    protected $fillable = [
        'Vouchertype',
        'employeename',
        'employeeid',
        'Voucheramount',
        'vouchernumber',
        'created_at',
        'updated_at',
        'created_by',
        'updated_by',

    ];
}
