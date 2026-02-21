<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class RouteStop extends Model
{
    use HasFactory;
    use LogsActivity;
    protected $table = 'route_stops';

    protected $fillable = [
        'routeid',
        'customerid',
        'itemid',
        'itemqty',
        'itemweight',
        'rateofsale',
        'created_by',
        'updated_by',
    ];
    public function route()
    {
        return $this->belongsTo(RouteBuilder::class, 'routeid');
    }

    public function customer()
    {
        return $this->belongsTo(CustomerMaster::class, 'customerid');
    }

    public function item()
    {
        return $this->belongsTo(ItemMaster::class, 'itemid');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }
}
