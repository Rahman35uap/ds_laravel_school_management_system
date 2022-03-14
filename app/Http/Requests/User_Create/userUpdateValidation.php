<?php

namespace App\Http\Requests\User_Create;

use App\Enums\UserType;
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

        if($user_type == UserType::Teacher)
        {
            // teacher
            return[
                "teacher_name" => 'required',
                "email" => 'required',
                "subjects" => 'required',
                "teacher_contact" => 'required'
            ];
        }
        elseif($user_type == UserType::Student)
        {
            //student
            return [
                //
                "student_name" => 'required',
                "email" => 'required',
                "class" => 'required',
                "section" => 'required',
                "father_name"=>'required',
                "mother_name"=>'required',
                "parent_contact"=>'required',
            ];
        }
        
    }
    public function messages()
    {
        $user_type = app('request')->get('user_type');
        if ($user_type == UserType::Teacher)
        {
            // teacher
            return [
                'teacher_name.required' => 'You must have to provide a teacher_name',
                'email.required' => 'You must have to provide a email',
                'subjects.required' => 'You must have to provide a subject',
                'teacher_contact.required' => 'You must have to provide a teacher_contact'
            ];
        }
        elseif($user_type == UserType::Student)
        {
            // student
            
            return [
                //
                "student_name.required" => "You must have to provide student_name",
               "email.required" => "You must have to provide email",
               "class.required" => "You must have to provide class",
               "section.required" => "You must have to provide section",
               "father_name.required"=>"You must have to provide father_name",
                "mother_name.required"=>"You must have to provide mother_name",
               "parent_contact.required"=>"You must have to provide parent_contact",
            ];
        }
        
    }
}
