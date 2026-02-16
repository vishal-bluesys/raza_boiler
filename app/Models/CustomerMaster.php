<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerMaster extends Model
{
    use HasFactory;
    protected $table = 'customer_master';
    protected $fillable = [
        'customer_name',
        'customer_typeid',
        'customer_mobile',
        'customer_email',
        'customer_owner_name',
        'customer_alternate_number',
        'customer_location',
        'totalsaleinkg',
        'totalbuisness',
        'totalbalance',
        'status',
    ];
}
