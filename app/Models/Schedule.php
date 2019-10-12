<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Schedule extends Model
{
    use SoftDeletes;

    public $table = 'schedules';

    protected $fillable = [
        'time', 
    ];


    public function groups()
    {
    	return $this->belongsToMany(Group::class);
    }
}
