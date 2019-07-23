<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Indicator extends Model
{
    use SoftDeletes;

    public $table = 'indicators';

    protected $fillable = [
        'description', 
        'status', 
        'function_name',
        'interval',
        'time_period',
        'series_type'
    ];

}
