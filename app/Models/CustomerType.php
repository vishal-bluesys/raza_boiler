<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerType extends Model
{
    use HasFactory;
        protected $table = 'customertype';
        public $timestamps = false;
        protected $primaryKey = 'id';
    // Define fillable fields as per your table structure
    protected $fillable = [
        'typename',
        'typeslug',
    ];
}
