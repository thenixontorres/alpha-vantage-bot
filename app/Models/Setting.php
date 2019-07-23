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
        'type_request',
        'strict_time_request',
        'alpha_vantage_key',
        'notifications_mail'
    ];
}
