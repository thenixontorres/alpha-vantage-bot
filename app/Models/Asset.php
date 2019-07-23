<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Asset extends Model
{
    use SoftDeletes;

    public $table = 'assets';

    protected $fillable = [
        'symbol', 
        'status', 
        'name',
        'type'
    ];

    public function scanners()
    {
        return $this->hasMany(Scanner::class, 'asset_id');
    }

    public function scannersTo()
    {
        return $this->hasMany(Scanner::class, 'asset_to_id');
    }
}
