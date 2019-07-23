<?php

namespace App\Http\Controllers\Backoffice;

use Illuminate\Http\Request;
use App\Http\Requests\Backoffice\ApiTestRequest;
use App\Http\Controllers\Controller;
use App\Abstracts\AlphaVantage;

class AlphaVantageController extends Controller
{

    /*
        https://www.alphavantage.co/documentation/#symbolsearch
    */
    public function autocomplete(Request $request)
    {
    	$response = AlphaVantage::get('SYMBOL_SEARCH', $request->all());
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
