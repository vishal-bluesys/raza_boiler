<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Maintanance extends Model
{
    use HasFactory;
    use LogsActivity;
    protected $table = 'maintanance';
    // Define fillable fields as per your table structure
    protected $fillable = [
       'vehicleid',
       'maintanancetype',
       'maintanancecost',
       'maintanancedate',
       'created_by',
        'updated_by',
        'created_at',
        'updated_at',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }
}
