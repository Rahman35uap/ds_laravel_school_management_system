<?php

namespace App\Http\Requests\User_Create;

use Illuminate\Foundation\Http\FormRequest;

class userCreateValidation extends FormRequest
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
            "teacher_name" => 'required',
            "email" => 'required',
            "subjects" => 'required',
            "teacher_contact" => 'required'
        ];
    }
    public function messages()
    {
        return [
            'teacher_name.required' => 'You must have to provide a teacher_name',
            'email.required' => 'You must have to provide a email',
            'subjects.required' => 'You must have to provide a subject',
            'teacher_contact.required' => 'You must have to provide a teacher_contact'
        ];
    }
}
