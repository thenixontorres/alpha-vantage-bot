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

    public function type($type = 'stock_market')
    {
    	/*assets para el select*/
    	$assets = Asset::orderBy('created_at', 'desc')->where('status', 'on')->where('type', $type)->pluck('symbol', 'id');
    	
        /*estrategias para el dropdown*/
        $strategies = Strategy::orderBy('created_at', 'desc')->where('status', 'on')->get();

        /*escanners para la tabla*/
        $scanners = Scanner::where('user_id', Auth::user()->id)->where('scanner_type', $type)->orderBy('scanners.created_at', 'desc')->paginate(15);

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

		$create = $this->scannerRepository->create($input);

        toast($create['message'], $create['type'] ,'top-right');

        return redirect()->back();
	}

	public function edit(Scanner $scanner){

		$intervals = $this->scannerRepository->getIntervals();

        $series = $this->scannerRepository->getSeries();

    	//$assets = Asset::orderBy('created_at', 'desc')->where('status', 'on')->pluck('symbol', 'id');

        //dd($scanner->settings_array);
        return view('backoffice.scanners.edit')
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

	public function show(Scanner $scanner)
	{ 
	    return view('backoffice.scanners.show')
			->with('scanner', $scanner);
	}

	public function apply(Scanner $scanner)
	{
		$response = $this->scannerRepository->applyStrategy($scanner);
		
		return response()->json($response, $response['code']);
	}

	public function destroy(Scanner $scanner)
	{
		$scanner->strategies()->detach();
		
		foreach ($scanner->signals as $signal) 
		{
			$signal->delete();
		}

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
}
