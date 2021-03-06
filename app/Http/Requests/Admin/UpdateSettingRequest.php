<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
 
class UpdateSettingRequest extends FormRequest
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
            'status' => 'required',
            'scanners_limit' => 'integer|required',
            'notifications_mail' => 'bail|required',
            'alpha_vantage_api' => 'required',
            'request_per_minute' => 'required',
        ];
    }
}
