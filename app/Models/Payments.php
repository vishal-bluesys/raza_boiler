<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    use HasFactory;

    protected $table = 'payments';

    protected $fillable = [
        'usertype',
        'userid',
        'paymentamount',
        'paymenttype',
        'paymentmode',
        'transaction_cheque_no',
        'paymentdate',
        'created_by',
        'updated_by',
    ];

    // Relation to CustomerMaster (if usertype is customer)
    public function customerMaster()
    {
        return $this->belongsTo(CustomerMaster::class, 'userid');
    }

    // Relation to CompanyMaster (if usertype is company)
    public function companyMaster()
    {
        return $this->belongsTo(CompanyMaster::class, 'userid');
    }

    // Relation to CustomerUser (if usertype is customer)
    public function customerUser()
    {
        return $this->belongsTo(CustomerUser::class, 'userid');
    }

    // Relation to CompanyUser (if usertype is company)
    public function companyUser()
    {
        return $this->belongsTo(CompanyUser::class, 'userid');
    }
}
