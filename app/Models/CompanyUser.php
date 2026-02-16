<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CompanyUser extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'company_user';
    protected $fillable = [
        'companyid',
        'userid',
        'created_at',
    ];

    public function company()
    {
        return $this->belongsTo(CompanyMaster::class, 'companyid');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'userid');
    }
}
