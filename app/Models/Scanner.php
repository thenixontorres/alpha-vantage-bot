<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Presenters\ScannerPresenter;

class Scanner extends Model
{
 	use SoftDeletes, ScannerPresenter;

    public $table = 'scanners';

    protected $fillable = [
        'settings',
        'asset_id',
        'asset_to_id',
        'interval',
        'status',
        'email_notifications',
        'pool_notifications',
        'scanner_type',
        'user_id',
        'group_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function asset()
    {
        return $this->belongsTo(Asset::class, 'asset_id');
    }

    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id');
    }

    public function assetTo()
    {
        return $this->belongsTo(Asset::class, 'asset_to_id');
    }

    public function strategies()
    {
        return $this->belongsToMany(Strategy::class);
    }

    public function signals()
    {
        return $this->hasMany(Signal::class);
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}
