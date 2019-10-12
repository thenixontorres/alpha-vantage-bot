<?php

namespace App\Http\Controllers\Backoffice;

use Illuminate\Http\Request;
use App\Http\Requests\Backoffice\CreateScannerRequest;
use App\Http\Requests\Backoffice\UpdateScannerRequest;
use App\Http\Requests\Backoffice\UpdateScannerSettingsRequest;
use App\Http\Requests\Backoffice\DetachStrategyRequest;
use App\Http\Requests\Backoffice\AttachStrategyRequest;
use App\Repositories\ScannerRepository;
use App\Http\Controllers\Controller;
use App\Models\Scanner;
use App\Models\Asset;
use App\Models\Strategy;
use App\Models\Group;
use Auth;
use App\Abstracts\AlphaVantage;
/**
 * Class IndicatorsController.
 *
 * @package namespace App\Http\Controllers;
 */
class ScannerController extends Controller
{
    private $scannerRepository;

 	public function __construct(ScannerRepository $scannerRepo)
    {
        $this->scannerRepository = $scannerRepo;
    }

    public function index($type = 'all')
    {        
        /*estrategias para el dropdown*/
        $strategies = Strategy::orderBy('created_at', 'desc')->where('status', 'on')->get();

        if ($type != 'all') 
        {
        	 /*assets para el select*/
    		$assets = 
    			Asset::orderBy('created_at', 'desc')
    			->where('status', 'on')
    			->where('type', $type)
    			->pluck('symbol', 'id');

        	/*escanners para la tabla*/
        	$scanners = 
        		Scanner::where('user_id', Auth::user()->id)
        		->where('scanner_type', $type)
        		->orderBy('scanners.created_at', 'desc')
        		->get();
        }else{
        	/*assets para el select*/
    		$assets = [];

        	/*escanners para la tabla*/
        	$scanners = 
        		Scanner::where('user_id', Auth::user()->id)
        		->orderBy('scanners.created_at', 'desc')
        		->get();
        }
       
        return view('backoffice.scanners.index')
        	->with('type', $type)
            ->with('scanners', $scanners)
            ->with('strategies', $strategies)
            ->with('assets', $assets);
    }

	public function store(CreateScannerRequest $request)
	{
		$input = $request->validated();
				
		$input['user_id'] = auth()->user()->id;

        $limit = getSetting('scanners_limit');

        if (auth()->user()->scanners->count() >= $limit) 
        {
            toast('Tu cuenta tiene un limite de '.$limit.' escaners', 'error' ,'top-right');

            return redirect()->back();
        }

		$create = $this->scannerRepository->create($input);

        toast($create['message'], $create['type'] ,'top-right');

        return redirect()->back();
	}

	public function edit(Scanner $scanner){

		if ($scanner->user_id != auth()->user()->id) 
        {
            toast('Permiso denegado', 'error' ,'top-right');
        
            return redirect()->back();
        }

		$intervals = $this->scannerRepository->getIntervals();

        $series = $this->scannerRepository->getSeries();

        $groups = Auth::user()->groups->pluck('name','id');
    	//$assets = Asset::orderBy('created_at', 'desc')->where('status', 'on')->pluck('symbol', 'id');

        //dd($scanner->settings_array);
        return view('backoffice.scanners.edit')
            ->with('groups', $groups)
			->with('scanner', $scanner)
			->with('intervals', $intervals)
			->with('series', $series);
	}

	public function update(UpdateScannerRequest $request, Scanner $scanner)
	{
		if ($scanner->user_id != auth()->user()->id) 
        {
            toast('Permiso denegado', 'error' ,'top-right');
        
            return redirect()->back();
        }

		$input = $request->validated();

		$update = $this->scannerRepository->update($input, $scanner);
        
        toast($update['message'], $update['type'] ,'top-right');

        return redirect()->back();
	}

	public function updateSettings(UpdateScannerSettingsRequest $request, Scanner $scanner)
	{		
		if ($scanner->user_id != auth()->user()->id) 
        {
            toast('Permiso denegado', 'error' ,'top-right');
        
            return redirect()->back();
        }

		$input = $request->validated();

		$update = $this->scannerRepository->updateSettings($scanner, $input);

        toast($update['message'], $update['type'] ,'top-right');

        return redirect()->back();

	}

	public function updateStatus(Request $request, Scanner $scanner){
		
		if ($scanner->user_id != auth()->user()->id) 
        {
            toast('Permiso denegado', 'error' ,'top-right');
        
            return redirect()->back();
        }

		$scanner->status = $request->status;
		
		$scanner->update();

        toast('Estatus cambiado con exito', 'success' ,'top-right');

		return redirect()->back();
	}

    public function updateEmail(Request $request, Scanner $scanner){
        
        if ($scanner->user_id != auth()->user()->id) 
        {
            toast('Permiso denegado', 'error' ,'top-right');
        
            return redirect()->back();
        }

        $scanner->email_notifications = $request->email_notifications;
        
        $scanner->update();

        toast('Estatus cambiado con exito', 'success' ,'top-right');

        return redirect()->back();
    }

    public function updatePool(Request $request, Scanner $scanner){
        
        if ($scanner->user_id != auth()->user()->id) 
        {
            toast('Permiso denegado', 'error' ,'top-right');
        
            return redirect()->back();
        }

        $scanner->pool_notifications = $request->pool_notifications;
        
        $scanner->update();

        toast('Estatus cambiado con exito', 'success' ,'top-right');

        return redirect()->back();
    }

	public function show(Scanner $scanner)
	{ 
		if ($scanner->user_id != auth()->user()->id) 
        {
            toast('Permiso denegado', 'error' ,'top-right');
        
            return redirect()->back();
        }

	    return view('backoffice.scanners.show')
			->with('scanner', $scanner);
	}

	public function apply(Scanner $scanner)
	{
		if ($scanner->user_id != auth()->user()->id) 
        {
            toast('Permiso denegado', 'error' ,'top-right');
        
            return redirect()->back();
        }

        $response = $this->scannerRepository->applyStrategy($scanner, 'test', now());
		
		return response()->json($response, $response['code']);
	}

	public function destroy(Scanner $scanner)
	{
		if ($scanner->user_id != auth()->user()->id) 
        {
            toast('Permiso denegado', 'error' ,'top-right');
        
            return redirect()->back();
        }

		$scanner->delete();

        toast('Escaner borrado con exito', 'success' ,'top-right');

        return redirect()->back();

	}

	public function detachStrategy(DetachStrategyRequest $request)
	{

		$scanner = Scanner::find($request->scanner_id);

		if ($scanner->user_id != auth()->user()->id) 
        {
            toast('Permiso denegado', 'error' ,'top-right');
        
            return redirect()->back();
        }

		$response = $this->scannerRepository->detachStrategy($scanner, $request->strategy_id);

        toast($response['message'], $response['type'] ,'top-right');

        return redirect()->back();

	}

	public function attachStrategy(AttachStrategyRequest $request)
	{

		$scanner = Scanner::find($request->scanner_id);

		if ($scanner->user_id != auth()->user()->id) 
        {
            toast('Permiso denegado', 'error' ,'top-right');
        
            return redirect()->back();
        }
        
		$response = $this->scannerRepository->attachStrategy($scanner, $request->strategy_id);

        toast($response['message'], $response['type'] ,'top-right');

        return redirect()->back();

	}
}
