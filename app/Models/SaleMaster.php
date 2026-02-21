<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
class SaleMaster extends Model
{
    use LogsActivity;
    protected $table = 'sale_master';
    protected $fillable = [
        'customerid', 'saledate', 'salestatus', 'created_by', 'updated_by'
    ];

    public function saleitems()
    {
        return $this->hasMany(SaleItem::class, 'saleid');
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
