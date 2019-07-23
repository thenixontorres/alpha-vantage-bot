<?php

namespace App\Http\Controllers\Backoffice;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backoffice\UpdateSettingRequest;
use App\Repositories\ScannerRepository;
use App\Models\Setting;

class SettingController extends Controller
{

    private $scannerRepository;

    public function __construct(ScannerRepository $scannerRepo)
    {
        $this->scannerRepository = $scannerRepo;
    }

    public function index()
    {
    	$setting = Setting::first();
        
        /*se milisegundos a sengundos*/
        //$setting->strict_time_request = $setting->strict_time_request/1000;

        $intervals = $this->scannerRepository->getIntervals();

    	return view('backoffice.settings.index')
            ->with('setting', $setting)
            ->with('intervals', $intervals);
    }

    public function update(UpdateSettingRequest $request, Setting $setting)
    {
    	$input = $request->validated();

        /*de segundos a milisegundos*/
        //$input['strict_time_request'] = $input['strict_time_request']*1000;

        $setting->fill($input);

    	$setting->update();

        toast('Configuraciones actualizadas con exito', 'success' ,'top-right');

        return redirect()->back();
    }
}
