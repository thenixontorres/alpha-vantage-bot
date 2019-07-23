<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Presenters\SignalPresenter;

class Signal extends Model
{
    use SoftDeletes, SignalPresenter;

    public $table = 'signals';

    protected $fillable = [
        'scanner_id',
        'status',
        'data',
    ];

    public function scanner()
    {
        return $this->belongsTo(Scanner::class);
    }
}
