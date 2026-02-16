<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CustomerUser extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'customer_user';
    protected $fillable = [
        'customerid',
        'userid',
        'created_at',
    ];

    public function customer()
    {
        return $this->belongsTo(CustomerMaster::class, 'customerid');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'userid');
    }
}
