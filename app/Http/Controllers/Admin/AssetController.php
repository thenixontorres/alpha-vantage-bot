<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateAssetRequest;
use App\Models\Asset;
use App\Models\Strategy;

class AssetController extends Controller
{

    public function index($type = 'all')
    {
        if ($type != 'all') 
        {
            $assets = Asset::orderBy('created_at', 'desc')->where('type', $type)->get();
        }else{
            $assets = Asset::orderBy('created_at', 'desc')->get();
        }
                
        return view('admin.assets.index')
            ->with('type', $type)
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
        $asset->delete();

        toast('Activo borrado con exito', 'success' ,'top-right');

        return redirect()->back();
    }
}
