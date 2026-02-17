<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class VouchersType extends Model
{
    use HasFactory;
    use LogsActivity;
    protected $table = 'vouchertype';
    // Define fillable fields as per your table structure
    protected $fillable = [
        // 'field1', 'field2', ...
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }
}
