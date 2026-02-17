<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class CompanyUser extends Model
{
    use HasFactory;
    use LogsActivity;
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

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }
}
