<?php

namespace App\Http\Requests\Backoffice;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UpdateScannerSettingsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        $rules = $this->getRules($request->get('code'));

        return $rules;
    }

    public function getRules($code)
    {
        if ($code == 'MA_SINGLE') 
        {
            return [
                'code' => 'required',
                'function' => 'required',
                'symbol' => 'required',
                'series_type' => 'required',
                'interval' => 'required',
                'time_period' => 'integer|required',
            ];

        }elseif($code == 'MA_DOUBLE')
        { 
            return [
                'code' => 'required',
                'slow' => 'array|required|min:2',
                'slow.*' => 'required',
                'fast' => 'array|required|min:2',
                'fast.*' => 'required',
                'symbol' => 'required',
                'interval' => 'required',
                'series_type' => 'required'
            ];
        }elseif($code == 'STOCH')
        {
            return [
                'code' => 'required',
                'function' => 'required',
                'fastkperiod' => 'integer|required',
                'slowkperiod' => 'integer|required',
                'slowdperiod' => 'integer|required',
                'slowkmatype' => 'integer|required|between:0,8',
                'slowdmatype' => 'integer|required|between:0,8',
                'symbol' => 'required',
                'interval' => 'required',
            ];
        }elseif($code == 'BBANDS'){
            return [
                'code' => 'required',
                'function' => 'required',
                'nbdevup' => 'integer|required',
                'nbdevdn' => 'integer|required',
                'matype' => 'integer|required',
                'series_type' => 'required',
                'symbol' => 'required',
                'interval' => 'required',
                'time_period' => 'required'
            ];
        }elseif($code == 'RSI'){
            return [
                'code' => 'required',
                'function' => 'required',
                'series_type' => 'required',
                'symbol' => 'required',
                'interval' => 'required',
                'time_period' => 'required'
            ];
        }


        return [];
    }
}
