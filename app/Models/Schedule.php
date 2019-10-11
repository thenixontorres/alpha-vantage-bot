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
        'scanner_id'
    ];


    public function scanner()
    {
    	return $this->belongsTo(Scanner::class);
    }
}
