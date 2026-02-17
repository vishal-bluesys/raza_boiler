<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class CustomerType extends Model
{
    use HasFactory;
    use LogsActivity;
        protected $table = 'customertype';
        public $timestamps = false;
        protected $primaryKey = 'id';
    // Define fillable fields as per your table structure
    protected $fillable = [
        'typename',
        'typeslug',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }
}
