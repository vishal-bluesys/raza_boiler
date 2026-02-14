<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $table = 'modules';
    protected $fillable = [
        'name',
        'slug',
        'icon',
        'status',
        'created_at',
    ];
    public $timestamps = false;
}
