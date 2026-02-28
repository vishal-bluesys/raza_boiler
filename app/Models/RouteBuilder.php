<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
class RouteBuilder extends Model
{
    use HasFactory;
    use LogsActivity;
    protected $table = 'route_builder';

    protected $fillable = [
        'routename',
           'vehicleid',
           'driverid',
           'deliverydate',
           'status',
           'type',
           'created_by',
           'updated_by',
    ];

    function route_stops()
    {
        return $this->hasMany(RouteStop::class, 'routeid');
    }

    function vehicle()
    {
        return $this->belongsTo(VehicleMaster::class, 'vehicleid');
    }

    function driver()
    {
        return $this->belongsTo(User::class, 'driverid');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }
}
 
