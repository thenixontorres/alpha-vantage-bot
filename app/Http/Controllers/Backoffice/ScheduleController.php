<?php

namespace App\Http\Controllers\Backoffice;

use Illuminate\Http\Request;
use App\Http\Requests\Backoffice\CreateScheduleRequest;
use App\Http\Controllers\Controller;
use App\Models\Scanner;
use App\Models\Schedule;
use App\Repositories\ScheduleRepository;

class ScheduleController extends Controller
{
 	private $scheduleRepository;

    public function __construct(ScheduleRepository $scheduleRepo)
    {
        $this->scheduleRepository = $scheduleRepo;
    }

    public function index(){
        $schadules_used = $this->scheduleRepository->getSchadulesUsed();

        return view('backoffice.schedules.index')
            ->with('schadules_used', $schadules_used);
    }

    public function edit(Scanner $scanner)
    {
    	$schadules_used = $this->scheduleRepository->getSchadulesUsed();

    	return view('backoffice.schedules.edit')
    		->with('scanner', $scanner)
    		->with('schadules_used', $schadules_used);
    }

    public function store(CreateScheduleRequest $request)
    {
        $input = $request->validated();

        $scanner = Scanner::find($input['scanner_id']);

        if (empty($scanner)) 
        {
            toast('Escaner no encontrado', 'error' ,'top-right');

            return redirect()->back();
        }

        $scanner->schedules()->delete();

        foreach ($input['schedules'] as $time) 
        {
            $schedule = new Schedule();
            
            $schedule->create([
                'scanner_id' => $scanner->id,
                'time' => $time
            ]);
        }

        toast('Horario programado con exito', 'success' ,'top-right');

        return redirect()->back();

    }

    public function getScannerSchedules(Scanner $scanner)
    {
        $schedules = $this->scheduleRepository->getScannerSchedules($scanner);

        return response()->json($schedules, 200);
    }
}
