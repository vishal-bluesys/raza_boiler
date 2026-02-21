<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
class Orderitem extends Model
{
    use HasFactory;
    use LogsActivity;
    protected $table = 'orderitems';

    protected $fillable = [
        'orderid',
        'itemid',
        'itemweight',
        'status',
        'created_by',
        'updated_by',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'orderid');
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
