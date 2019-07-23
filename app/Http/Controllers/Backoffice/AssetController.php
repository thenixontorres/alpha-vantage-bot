<?php

namespace App\Http\Controllers\Backoffice;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backoffice\CreateAssetRequest;
use App\Models\Asset;
use App\Models\Strategy;
use App\Abstracts\AlphaVantage;

class AssetController extends Controller
{
    /*
    public function index()
    {    	
        $assets = Asset::orderBy('created_at', 'desc')->where('status', 'on')->paginate(15);
        
        $strategies = Strategy::orderBy('created_at', 'desc')->where('status', 'on')->get();

        return view('backoffice.assets.index')
            ->with('strategies', $strategies)
            ->with('assets', $assets);
    }
    */

    public function type($type = 'stock_market')
    {
        $assets = Asset::orderBy('created_at', 'desc')->where('type', $type)->paginate(15);
        
        $strategies = Strategy::orderBy('created_at', 'desc')->where('status', 'on')->get();
        
        return view('backoffice.assets.index')
            ->with('type', $type)
            ->with('strategies', $strategies)
            ->with('assets', $assets);
    }

    public function create()
    {       
        $assets = Asset::orderBy('created_at', 'desc')->paginate(15);
        
        return view('backoffice.assets.create')
            ->with('assets', $assets);
    }


    public function store(CreateAssetRequest $request)
    {
        $symbol = explode('--:', $request->keywords);

        $input = [
            'symbol' => $symbol[1],
            'name' =>  $symbol[0],
            'type' => $request->type
        ];

        $asset = new Asset();
        
        $asset->create($input);

        toast('Activo registrado con exito', 'success' ,'top-right');

        return redirect()->back();
    }

    public function changeStatus(Request $request)
    {
        $asset = Asset::find($request->id);

        $asset->status = $request->status;

        $asset->update();

        toast('Activo actualizado con exito', 'success' ,'top-right');

        return redirect()->back();
    }

    public function destroy(Asset $asset)
    {
        if (!empty($asset->scanner)) 
        {
            $asset->scanner->delete();
        }
        
        $asset->delete();

        toast('Activo borrado con exito', 'success' ,'top-right');

        return redirect()->back();
    }
}
