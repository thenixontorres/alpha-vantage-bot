<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateSettingRequest;
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

    	return view('admin.settings.index')
            ->with('setting', $setting)
            ->with('intervals', $intervals);
    }

    public function update(UpdateSettingRequest $request, Setting $setting)
    {
    	$input = $request->validated();

        $setting->fill($input);

    	$setting->update();

        toast('Configuraciones actualizadas con exito', 'success' ,'top-right');

        return redirect()->back();
    }
}
