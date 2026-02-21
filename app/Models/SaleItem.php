<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaleItem extends Model
{
    protected $table = 'saleitems';
    protected $fillable = [
        'saleid', 'itemid', 'itemweight', 'itemqty', 'actualrate', 'salerate', 'discounttype', 'discount', 'totalsale', 'created_by', 'updated_by'
    ];

    public function saleMaster()
    {
        return $this->belongsTo(SaleMaster::class, 'saleid');
    }
}
