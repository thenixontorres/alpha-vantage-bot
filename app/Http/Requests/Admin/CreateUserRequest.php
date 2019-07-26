<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Auth;

class CreateUserRequest extends FormRequest
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
            'email' => [
                'bail',
                'email',
                'required',
                Rule::unique('users'),
            ],
            'name' => [
                'required',
                Rule::unique('users'),
            ],
            'password' => [
                'nullable',
            ],
            'status' => 'required',
            'type' => 'required'
        ];
    }
}
