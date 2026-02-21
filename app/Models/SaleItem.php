<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
class SaleItem extends Model
{
    use LogsActivity;
    protected $table = 'saleitems';
    protected $fillable = [
        'saleid', 'itemid', 'itemweight', 'itemqty', 'actualrate', 'salerate', 'discounttype', 'discount', 'totalsale', 'created_by', 'updated_by'
    ];

    public function saleMaster()
    {
        return $this->belongsTo(SaleMaster::class, 'saleid');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }
}
