<?php

namespace App\Http\Controllers\Backoffice;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Signal;

class ChartController extends Controller
{
    public function getSignalsData()
    {
    	$signals = Signal::orderBy('created_at', 'DESC')
                ->join('scanners', 'signals.scanner_id', '=', 'scanners.id')
                ->select(['signals.*', 'scanners.scanner_type'])
                ->where('scanners.user_id', '=', auth()->user()->id)
                ->get();
        
        $total = $signals->count(); 
        $ignored = $signals->where('status', 'ignored')->count();
        $success = $signals->where('status', 'success')->count();
        $failed = $signals->where('status', 'failed')->count();

        if ($total > 0) 
        {
        	$ignored = ($ignored*100)/$total;
        	$success = ($success*100)/$total;
        	$failed = ($failed*100)/$total;
        }

        $data['labels'] = [
        	'Acertadas',
        	'Fallidas',
        	'Ignoradas'
        ];

        $data['porcents'] = [
        	$success,
        	$failed,
        	$ignored
        ];

        $data['backgrounds'] = [
        	'#40CC72',
        	'#fe413b',
        	'#737373',
        ];

    	return response()->json($data, 200);
    }
}
