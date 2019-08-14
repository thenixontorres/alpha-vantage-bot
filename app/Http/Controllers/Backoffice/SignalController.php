<?php

namespace App\Http\Controllers\Backoffice;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Signal;
use App\Mail\SignalNotificationMail;
use App\Http\Requests\Backoffice\UpdateSignalRequest;

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
                ->where('scanners.user_id', '=', auth()->user()->id)
                ->get();
        }else{
            $signals = Signal::orderBy('created_at', 'DESC')
                ->join('scanners', 'signals.scanner_id', '=', 'scanners.id')
                ->select(['signals.*', 'scanners.scanner_type'])
                ->where('scanners.user_id', '=', auth()->user()->id)
                ->get();
        }

    	return view('backoffice.signals.index')
    		->with('signals', $signals);

    }

    public function update(UpdateSignalRequest $request, Signal $signal)
    {
        if ($signal->scanner->user_id != auth()->user()->id) 
        {
            toast('Permiso denegado', 'error' ,'top-right');
        
            return redirect()->back();
        }

        $signal->status = $request->status;
        $signal->update();

        toast('Alerta actualizada con exito', 'success' ,'top-right');

        return redirect()->back();
    }

    public function show(Signal $signal)
    {

        return new SignalNotificationMail($signal);

    }
}
