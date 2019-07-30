<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\ScannerValdation;

class CreateScannerRequest extends FormRequest
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
    public function rules()
    {
        return [
            'user_id' => ['integer','required'],
            'asset_id' => ['integer','required'],
            'strategy_id' => ['array','required'],
            'scanner_type' => 'required',
            'asset_to_id' => ['required_if:scanner_type,==,physical']
        ];
    }
}
