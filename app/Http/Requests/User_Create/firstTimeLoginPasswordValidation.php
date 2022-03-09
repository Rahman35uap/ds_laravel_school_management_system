<?php

namespace App\Http\Requests\User_Create;

use Illuminate\Foundation\Http\FormRequest;

class firstTimeLoginPasswordValidation extends FormRequest
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
            //
            "new_pass" => 'required',
            "confirm_pass" => 'required'
        ];
    }
    public function messages()
    {
        return [
            'new_pass.required' => 'You must have to provide a new password',
            'confirm_pass.required' => 'You have to confirm your new password'
        ];
    }
}
