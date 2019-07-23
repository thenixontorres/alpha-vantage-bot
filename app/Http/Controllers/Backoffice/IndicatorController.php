<?php

namespace App\Http\Controllers\Backoffice;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backoffice\UpdateIndicatorRequest;
use App\Models\Indicator;

/**
 * Class IndicatorsController.
 *
 * @package namespace App\Http\Controllers;
 */
class IndicatorController extends Controller
{
    public function index()
    {
        $indicators = Indicator::orderBy('created_at', 'desc')->paginate(10);

        return view('backoffice.indicators.index')
            ->with('indicators', $indicators);
    }

    public function changeStatus(Request $request)
    {
        $indicator = Indicator::find($request->id);

        $indicator->status = $request->status;

        $indicator->update();

        toast('Indicador actualizado con exito', 'success' ,'top-right');

        return redirect()->back();
    }

    public function edit(Indicator $indicator)
    {
        $intervals  = [
            '1min' => '1min',
            '5min' => '5min',
            '15min' => '15min',
            '30min' => '30min',
            '60min' => '60min',
            'daily' => 'Diario',
            'weekly' => 'Semanal',
            'monthly' => 'Mensual'
        ];

        $series = [
            'close' => 'Cierre',
            'open' => 'Apertura',
            'high' => 'Alto',
            'low' => 'Bajo'
        ];

        return view('backoffice.indicators.edit')
            ->with('intervals', $intervals)
            ->with('series', $series)
            ->with('indicator', $indicator);
    }

    public function update(UpdateIndicatorRequest $request, Indicator $indicator)
    {
        $indicator->fill($request->validated());
       
        $indicator->update();

        toast('Indicador actualizado con exito', 'success' ,'top-right');

        return redirect()->back();
    }
}
