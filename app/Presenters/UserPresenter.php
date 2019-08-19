<?php

namespace App\Presenters;
use App\Models\Signal;

trait UserPresenter
{
	public function getCountSignalsAttribute()
	{
		
		$signals = 	
			Signal::join('scanners', 'signals.scanner_id','=', 'scanners.id')
			->where('scanners.user_id','=',$this->id)
			->count();

		return $signals;
	}

}