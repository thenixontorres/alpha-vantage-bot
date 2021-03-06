<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Setting extends Model
{
 	use SoftDeletes;

    public $table = 'settings';

    protected $fillable = [
        'status',
        'alpha_vantage_api',
        'notifications_mail',
        'scanners_limit',
        'request_per_minute'
    ];
}
