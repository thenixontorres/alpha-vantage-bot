<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Key extends Model
{
    use SoftDeletes;

    public $table = 'keys';

    protected $fillable = [
        'key', 
        'email',
        'is_active', 
        'name',
    ];
}
