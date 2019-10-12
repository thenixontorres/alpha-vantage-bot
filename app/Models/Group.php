<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
    use SoftDeletes;

    public $table = 'groups';

	protected $fillable = [
        'name', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function schedules()
    {
        return $this->belongsToMany(Schedule::class);
    }

    public function scanners()
    {
        return $this->hasMany(Scanner::class);
    }
}
