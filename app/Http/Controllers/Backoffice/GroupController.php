<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Requests\Backoffice\CreateGroupRequest;
use App\Http\Requests\Backoffice\UpdateGroupRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\Schedule;
use Auth;
use App\Repositories\GroupRepository;

class GroupController extends Controller
{
    private $groupRepository;

    public function __construct(GroupRepository $groupRepo)
    {
        $this->groupRepository = $groupRepo;
    }

    public function index()
    {
    	$schedules = Schedule::orderBy('time', 'ASC')->pluck('time', 'id');
    	
    	return view('backoffice.groups.index')
    		->with('schedules', $schedules);
    }

    public function store(CreateGroupRequest $request)
    {

    	$input = $request->validated();

        $input['user_id'] = Auth::user()->id;

        $create = $this->groupRepository->create($input);

    	toast($create['message'],$create['type'],'top-right');

        return redirect()->back();
    }

    public function edit(Group $group)
    {
        if($group->user_id != Auth::user()->id)
        {
            return redirect()->back();
        }

        $schedules = [];

        return view('backoffice.groups.edit')
            ->with('group', $group)
            ->with('schedules', $schedules);
    }

    public function update(Group $group, UpdateGroupRequest $request)
    {
        if($group->user_id != Auth::user()->id)
        {
            return redirect()->back();
        }

        $input = $request->validated();

        $update = $this->groupRepository->update($input, $group);

        toast($update['message'],$update['type'],'top-right');

        return redirect()->route('backoffice.groups.index');
    }


	public function destroy(Group $group)
	{
        if($group->user_id != Auth::user()->id)
        {
            return redirect()->back();
        }

		$group->schedules()->detach();

		$group->delete();

        toast('Grupo borrado con exito', 'success' ,'top-right');

        return redirect()->back();

	}

    public function getGroupSchedules(Group $group)
    {
        $schedules = $this->groupRepository->getGroupSchedules($group);

        return response()->json($schedules, 200);
    }

}
