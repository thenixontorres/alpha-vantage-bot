<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Strategy;
use App\Http\Requests\Admin\UpdateStrategyRequest;

class StrategyController extends Controller
{
    public function index($type = 'all')
    {   
        
        $strategies = Strategy::orderBy('created_at', 'ASC')->get();

        return view('admin.strategies.index')
            ->with('strategies', $strategies);

    }

    public function update(UpdateStrategyRequest $request, Strategy $strategy)
    {
        $strategy->status = $request->status;
        $strategy->update();

        toast('Estrategia actualizada con exito', 'success' ,'top-right');

        return redirect()->back();
    }
}
