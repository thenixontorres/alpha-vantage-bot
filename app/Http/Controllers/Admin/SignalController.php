<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Signal;
use App\Http\Requests\Admin\UpdateSignalRequest;

class SignalController extends Controller
{
    public function index($type = 'all')
    {   
        if ($type != 'all') 
        {
            $signals = Signal::orderBy('created_at', 'DESC')
                ->join('scanners', 'signals.scanner_id', '=', 'scanners.id')
                ->select(['signals.*', 'scanners.scanner_type'])
                ->where('scanners.scanner_type', '=', $type)
                ->get();
        }else{
            $signals = Signal::orderBy('created_at', 'DESC')
                ->join('scanners', 'signals.scanner_id', '=', 'scanners.id')
                ->select(['signals.*', 'scanners.scanner_type'])
                ->get();
        }

        return view('admin.signals.index')
            ->with('signals', $signals);

    }

    public function update(UpdateSignalRequest $request, Signal $signal)
    {
        $signal->status = $request->status;
        $signal->update();

        toast('Alerta actualizada con exito', 'success' ,'top-right');

        return redirect()->back();
    }
}
