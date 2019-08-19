<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\Admin\CreateScannerRequest;
use App\Http\Requests\Admin\UpdateScannerRequest;
use App\Http\Requests\Admin\UpdateScannerSettingsRequest;
use App\Http\Requests\Admin\DetachStrategyRequest;
use App\Http\Requests\Admin\AttachStrategyRequest;
use App\Repositories\ScannerRepository;
use App\Http\Controllers\Controller;
use App\Models\Scanner;
use App\Models\Asset;
use App\Models\Strategy;
use App\User;
use Auth;

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
                Scanner::orderBy('created_at', 'desc')
        		->where('scanner_type', $type)
        		->orderBy('scanners.created_at', 'desc')
        		->get();
        }else{
        	/*assets para el select*/
    		$assets = [];

        	/*escanners para la tabla*/
        	$scanners = 
                Scanner::orderBy('created_at', 'desc')
        		->orderBy('scanners.created_at', 'desc')
        		->get();
        }
        
        $users = User::where('status','active')->pluck('name', 'id');

        return view('admin.scanners.index')
        	->with('type', $type)
            ->with('scanners', $scanners)
            ->with('strategies', $strategies)
            ->with('assets', $assets)
            ->with('users', $users);
    }

	public function store(CreateScannerRequest $request)
	{
		$input = $request->validated();
			
		$create = $this->scannerRepository->create($input);

        toast($create['message'], $create['type'] ,'top-right');

        return redirect()->back();
	}

	public function edit(Scanner $scanner){

		$intervals = $this->scannerRepository->getIntervals();

        $series = $this->scannerRepository->getSeries();

        return view('admin.scanners.edit')
			->with('scanner', $scanner)
			->with('intervals', $intervals)
			->with('series', $series);
	}

	public function update(UpdateScannerRequest $request, Scanner $scanner)
	{
		$input = $request->validated();

		$update = $this->scannerRepository->update($input, $scanner);

        toast($update['message'], $update['type'] ,'top-right');

        return redirect()->back();
	}

	public function updateSettings(UpdateScannerSettingsRequest $request, Scanner $scanner)
	{		
		$input = $request->validated();

		$update = $this->scannerRepository->updateSettings($scanner, $input);

        toast($update['message'], $update['type'] ,'top-right');

        return redirect()->back();

	}

	public function updateStatus(Request $request, Scanner $scanner){
		
		$scanner->status = $request->status;
		
		$scanner->update();

        toast('Estatus cambiado con exito', 'success' ,'top-right');

		return redirect()->back();
	}

	public function destroy(Scanner $scanner)
	{
		$scanner->delete();

        toast('Escaner borrado con exito', 'success' ,'top-right');

        return redirect()->back();

	}

	public function detachStrategy(DetachStrategyRequest $request)
	{

		$scanner = Scanner::find($request->scanner_id);

		$response = $this->scannerRepository->detachStrategy($scanner, $request->strategy_id);

        toast($response['message'], $response['type'] ,'top-right');

        return redirect()->back();

	}

	public function attachStrategy(AttachStrategyRequest $request)
	{

		$scanner = Scanner::find($request->scanner_id);

		$response = $this->scannerRepository->attachStrategy($scanner, $request->strategy_id);

        toast($response['message'], $response['type'] ,'top-right');

        return redirect()->back();

	}

    public function show(Scanner $scanner)
    { 
        return view('admin.scanners.show')
            ->with('scanner', $scanner);
    }

    public function apply(Scanner $scanner)
    {
        $response = $this->scannerRepository->applyStrategy($scanner);
        
        return response()->json($response, $response['code']);
    }
}
