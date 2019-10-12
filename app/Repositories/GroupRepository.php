<?php

namespace App\Repositories;

use App\Models\Group;
use App\Models\Schedule;
use Carbon\CarbonImmutable;
use App\Repositories\BaseRepository;

/**
 *	Aplicacion de cada
 */
class GroupRepository extends BaseRepository
{
	public function model()
	{
		return Group::class;
	}

	public function create($inputs){

    	$group = new Group;
    	$group->fill($inputs);
    	$group->save();

        if(isset($inputs['schedules']))
        {
            foreach ($inputs['schedules'] as $schedule) 
            {
                $group->schedules()->attach($schedule);
            }
        }
    	
    	return [
			'group' => $group,
			'type' => 'success',
			'message' => 'Grupo registrado con exito'
		];
	}

    public function update($inputs, $group)
    {

        $group->fill($inputs);
        $group->update();

        $group->schedules()->detach();

        if(isset($inputs['schedules']))
        {
            foreach ($inputs['schedules'] as $schedule) 
            {
                $group->schedules()->attach($schedule);
            }
        }
        
        return [
            'group' => $group,
            'type' => 'success',
            'message' => 'Grupo actualiado con exito'
        ];
    }

	public function getGroupSchedules(Group $group){

		$groupSchedules = [];

    	$schedules = Schedule::orderBy('time', 'ASC')->pluck('time', 'id');

    	foreach ($schedules as $key => $time) 
    	{
			$groupSchedules[$key]['time'] = $time;
    		$groupSchedules[$key]['id'] = $key;
    		$groupSchedules[$key]['selected'] = (boolean) $group->schedules->where('time', $time)->count();
    	}

    	return array_values($groupSchedules);
	}
}