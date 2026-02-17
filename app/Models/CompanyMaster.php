<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class CompanyMaster extends Model
{
    use HasFactory;
    use LogsActivity;
    protected $table = 'company_master';
    // Define fillable fields as per your table structure
    protected $fillable = [
        'company_name',
        'company_mobile',
        'company_email',
        'company_owner_name',
        'company_gst_number',
        'company_location',
        'totalpurchaseinkg',
        'totalbuisness',
        'totalbalance',
        'status',
    ];
    public function companyUsers()
    {
        return $this->hasMany(CompanyUser::class, 'companyid');
    }

    public function users()
    {
        return $this->hasManyThrough(User::class, CompanyUser::class, 'companyid', 'id', 'id', 'userid');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }
}
