<?php

namespace App\Repositories;

use App\User;
use App\Models\Group;
use App\Repositories\BaseRepository;

/**
 *	Aplicacion de cada
 */
class UserRepository extends BaseRepository
{
	public function model()
	{
		return User::class;
	}

	public function create($inputs)
	{
		if (!empty($inputs['password'])) 
        {
            $inputs['password'] = bcrypt($inputs['password']);
        }else{
            $inputs['password'] = bcrypt($inputs['email']);
        }

        $user = new User();

        $user->fill($inputs);

        $user->save();

		$this->attachDefaultGroups($user);

		return true;
	}

	public function attachDefaultGroups(User $user)
	{
		$schedules = [];

		/*Grupo Londres - New York*/
		$group = new Group;
		$group->name = 'London - New York 8-12 (EST)';
		$group->user_id = $user->id;
		$group->save();

		for ($i=481; $i < 722; $i++) 
		{ 
			$schedules[] = $i;
		}

		$group->schedules()->attach($schedules);

		$schedules = [];

		/*Grupo Tokyo - londres*/
		$group = new Group;
		$group->name = 'Tokyo - Londres 15-16 (EST)';
		$group->user_id = $user->id;
		$group->save();

		for ($i=901; $i < 962; $i++) 
		{ 
			$schedules[] = $i;
		}

		$group->schedules()->attach($schedules);

		$schedules = [];

		/*Grupo Sydney - Tokyo*/
		$group = new Group;
		$group->name = 'Sydney - Tokyo 19-2 (EST)';
		$group->user_id = $user->id;
		$group->save();

		for ($i=1141; $i < 1440; $i++) 
		{ 
			$schedules[] = $i;
		}

		for ($i=1; $i < 122; $i++) 
		{ 
			$schedules[] = $i;
		}

		$group->schedules()->attach($schedules);

		return true;
	}

}