<?php

namespace App\Repositories;

use App\Models\Signal;
use Carbon\CarbonImmutable;
use App\Repositories\BaseRepository;

/**
 *	Aplicacion de cada
 */
class SignalRepository extends BaseRepository
{

	public function getLogsByDate($date, $type)
        {
                $date = CarbonImmutable::createFromFormat('Y-m-d', $date);

                $from = $date->startOfDay();

                $to = $date->endOfDay();

                $logs = Signal::orderBy('created_at', 'DESC')->whereBetween('created_at', [$from, $to])->get();

                if ($type != 'ALL') 
                {
                     foreach ($logs as $key => $log) 
                     {
                        if ($log->just_type != $type) 
                        {
                                $logs->pull($key);  
                        }
                     }
                }

                return $logs;

	}

	public function getLogsTab($limit = 12)
	{
                $logs = Signal::orderBy('created_at', 'DESC')->get();

                $tab = [];

                foreach ($logs as $key => $log) 
                {
                	$tab[$log->created_at->format('Y-m-d')] = 'scanner-'.$log->created_at->format('Y-m-d').'.log';

                	if ($key == $limit) 
                	{
                		break;
                	}
                }

                return $tab;
	}

	public function model()
	{
		return Signal::class;
	}
}