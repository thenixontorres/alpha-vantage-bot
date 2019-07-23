<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Presenters\StrategyPresenter;

class Strategy extends Model
{
 	use SoftDeletes, StrategyPresenter;

    public $table = 'strategies';

    protected $fillable = [
        'code',
        'title',
        'template',
        'status',
        'function_name'
    ];

    public function scanners()
    {
        return $this->belongsToMany(Scanner::class);
    }
}
