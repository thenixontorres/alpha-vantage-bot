<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Signal;
use App\Mail\SignalNotificationMail;
use App\Http\Requests\Admin\UpdateSignalRequest;
use App\Repositories\SignalRepository;

class SignalController extends Controller
{
    private $signalRepository;

    public function __construct(SignalRepository $signalRepo)
    {
        $this->signalRepository = $signalRepo;
    }
    
    public function index($type = 'all')
    {   
        if ($type != 'all') 
        {
            $signals = Signal::orderBy('created_at', 'DESC')
                ->join('scanners', 'signals.scanner_id', '=', 'scanners.id')
                ->select(['signals.*', 'scanners.scanner_type'])
                ->where('scanners.scanner_type', '=', $type)
                ->where('signals.valid', '=', true)
                ->get();
        }else{
            $signals = Signal::orderBy('created_at', 'DESC')
                ->join('scanners', 'signals.scanner_id', '=', 'scanners.id')
                ->select(['signals.*', 'scanners.scanner_type'])
                ->where('signals.valid', '=', true)
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

    /*Todas las alertas de las ultimas 12 horas*/
    public function logs($date=null, $type=null)
    {
        if (empty($date)) 
        {
            $date = now()->format('Y-m-d');
        }

        if (empty($type)) 
        {
            $type = 'ALL';
        }

        $logs = $this->signalRepository->getLogsByDate($date, $type);

        $logs_tab = $this->signalRepository->getLogsTab();

        return view('admin.signals.logs')
            ->with('type', $type)
            ->with('date', $date)
            ->with('logs', $logs)
            ->with('logs_tab', $logs_tab);

    }

    public function creanLogs($date, $type)
    {
        $logs = $this->signalRepository->getLogsByDate($date, $type);

        foreach ($logs as $log) 
        {
            $log->delete();
        }

        toast('Logs con fecha '. $date . ' tipo ' .$type . ' limpiados con exito', 'success' ,'top-right');

        return redirect()->back();
    }

    public function show(Signal $signal)
    {
        return view('admin.signals.show')
            ->with('signal', $signal);
    }
}
