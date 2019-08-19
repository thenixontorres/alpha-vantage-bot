<?php

namespace App\Http\Requests\Backoffice;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Auth;

class UpdateUserRequest extends FormRequest
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
        $user = Auth::user();

        return [
            'email' => [
                'bail',
                'email',
                'required',
                Rule::unique('users')->ignore($user->id),
            ],
            'name' => [
                'required',
                Rule::unique('users')->ignore($user->id),
            ],
            'password' => [
                'nullable',
            ],
        ];
    }
}
