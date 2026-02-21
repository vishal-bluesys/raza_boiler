<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
class Order extends Model
{
    use HasFactory;
    use LogsActivity;
    protected $table = 'orders';

    protected $fillable = [
        'customerid',
        'orderdate',
        'orderstatus',
        'created_by',
        'updated_by',
    ];

    public function items()
    {
        return $this->hasMany(Orderitem::class, 'orderid');
    }

    public function customer()
    {
        return $this->belongsTo(CustomerMaster::class, 'customerid');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }
}
