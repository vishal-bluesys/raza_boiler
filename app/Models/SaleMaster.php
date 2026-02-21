<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaleMaster extends Model
{
    protected $table = 'sale_master';
    protected $fillable = [
        'customerid', 'saledate', 'salestatus', 'created_by', 'updated_by'
    ];

    public function saleitems()
    {
        return $this->hasMany(SaleItem::class, 'saleid');
    }
}
