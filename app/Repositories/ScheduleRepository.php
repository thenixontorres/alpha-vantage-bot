<?php

namespace App\Repositories;

use App\Models\Scanner;
use App\Models\Schedule;
use Carbon\CarbonImmutable;
use App\Repositories\BaseRepository;

/**
 *	Aplicacion de cada
 */
class ScheduleRepository extends BaseRepository
{
	public function model()
	{
		return Schedule::class;
	}

	public function getSchadulesUsed()
	{
		$schedules = Schedule::orderBy('time', 'Asc')->get();

		$used = [];

		$request_per_minute = getSetting('request_per_minute'); 

		foreach ($schedules as $schedule) 
		{
			$time = $schedule->time;
			
			if (!isset($used[$schedule->time])) 
			{
				$ocuped = $schedule->scanner->request_list;
			}else{
				$ocuped = $used[$schedule->time]['ocuped']+$schedule->scanner->request_list;
			}

			$free = $request_per_minute-$ocuped;

			$used[$schedule->time] = [
					'time' => $time,
					'ocuped' => $ocuped,
					'free' => $free,
				];
		}

		return $used;
	}

	public function getScannerSchedules(Scanner $scanner)
	{
		$schedules = [];

		for ($hour=0; $hour < 24; $hour++) 
		{ 	
			$hour_str = str_pad($hour, 2, "0", STR_PAD_LEFT);

			for ($minutes=0; $minutes < 60; $minutes++) 
			{ 
				$minutes_str = str_pad($minutes, 2, "0", STR_PAD_LEFT);

				$time = $hour_str.':'.$minutes_str;
				$schedules[$time]['time'] = $time;
				$schedules[$time]['selected'] = (boolean) $scanner->schedules->where('time', $time)->count();
			}
		}

		return array_values($schedules);

	}
}