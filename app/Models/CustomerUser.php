<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class CustomerUser extends Model
{
    use HasFactory;
    use LogsActivity;
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

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }
}
