<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Vouchers extends Model
{
    use HasFactory;
    use LogsActivity;
    protected $table = 'vouchers';
    // Define fillable fields as per your table structure
    protected $fillable = [
        'Vouchertype',
        'employeename',
        'employeeid',
        'Voucheramount',
        'vouchernumber',
        'created_at',
        'updated_at',
        'created_by',
        'updated_by',

    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }
}
