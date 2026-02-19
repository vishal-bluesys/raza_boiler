<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchasemaster extends Model
{
    use HasFactory;

    protected $table = 'purchasemaster';

    protected $fillable = [
        'companyid',
        'purchasedate',
        'purchaseqty',
        'parchaseweight',
        'rateofpurchase',
        'status',
        'created_by',
        'updated_by',
    ];
}
