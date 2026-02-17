<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
class Module extends Model{
    use LogsActivity;
    protected $table = 'modules';
    protected $fillable = [
        'name',
        'slug',
        'icon',
        'status',
        'created_at',
    ];
    public $timestamps = false;
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }
}
