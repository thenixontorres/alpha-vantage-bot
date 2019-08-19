<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\AlphaVantage;

class AlphaVantageController extends Controller
{

    /*
        https://www.alphavantage.co/documentation/#symbolsearch
    */
    public function autocomplete(Request $request)
    {
        $data = $request->all();

        $data['function'] = 'SYMBOL_SEARCH';

        $alphaVantage = new AlphaVantage;

    	$response = $alphaVantage->get($data);
        
        /*Formateamos para el autocomplete*/
        $bestMatches = [];

        if (isset($response['bestMatches'])) 
        {
            foreach ($response['bestMatches'] as $bestMatc) 
            {
                $bestMatches[] = [
                    'name' => $bestMatc['2. name'].' --:'.$bestMatc['1. symbol'],
                ];
            }
        }
        
    	return response()->json($bestMatches, 200);
    }
}
