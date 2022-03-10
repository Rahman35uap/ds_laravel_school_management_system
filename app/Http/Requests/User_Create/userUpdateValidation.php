<?php

namespace App\Http\Requests\User_Create;

use Illuminate\Foundation\Http\FormRequest;

class userUpdateValidation extends FormRequest
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
        $user_type = app('request')->get('user_type');
        // $user_id_from_url = app('request')->segment(3);     // it's giving the third segment of url (after domain the counting will be started from 1)

        if($user_type == 1)
        {
            // teacher
            return[
                "teacher_name" => 'required',
                "email" => 'required',
                "subjects" => 'required',
                "teacher_contact" => 'required'
            ];
        }
        else
        {
            //student
            return [
                //

            ];
        }
        
    }
    public function messages()
    {
        $user_type = app('request')->get('user_type');
        if ($user_type == 1)
        {
            // teacher
            return [
                'teacher_name.required' => 'You must have to provide a teacher_name',
                'email.required' => 'You must have to provide a email',
                'subjects.required' => 'You must have to provide a subject',
                'teacher_contact.required' => 'You must have to provide a teacher_contact'
            ];
        }
        else
        {
            // student
        }
        
    }
}
