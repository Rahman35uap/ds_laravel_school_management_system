<?php

namespace App\Http\Requests\User_Create;

use App\Enums\UserType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class userTypeValidation extends FormRequest
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
            // 'user_type' => [new Enum(UserType::class)]
            'user_type' => ['required',Rule::in([UserType::Teacher,UserType::Student])]
        ];
    }
    public function messages()
    {
        return [
            'user_type.required' => 'You must have to provide a user_type'
        ];
    }
}
