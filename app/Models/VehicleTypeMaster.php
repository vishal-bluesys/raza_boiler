<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class VehicleTypeMaster extends Model
{
    use HasFactory;
    use LogsActivity;
    protected $table = 'vehicletypemaster';
    // Define fillable fields as per your table structure
    protected $fillable = [
        'vehicletype',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }
}
