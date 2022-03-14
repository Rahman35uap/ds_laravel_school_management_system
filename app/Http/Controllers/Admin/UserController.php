<?php

namespace App\Http\Controllers\Admin;

use App\Enums\UserType;
use App\Http\Controllers\Controller;
use App\Http\Requests\User_Create\userCreateValidation;
use App\Http\Requests\User_Create\userTypeValidation;
use App\Http\Requests\User_Create\userUpdateValidation;
use App\Models\Class_number;
use App\Models\Rel_subjects_teacher;
use App\Models\Section;
use App\Models\Student_details;
use App\Models\Subject;
use App\Models\Teacher_details;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Enum;
use Mail;
use Nette\Utils\Arrays;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['users_data'] = User::get();
        return view('admin.userCRUD.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(userTypeValidation $userTypeValidation)
    {
        //
        if($userTypeValidation->user_type == UserType::Teacher)
        {
            $data['user_type'] = $userTypeValidation->user_type;
            $subjects = Subject::first();
            $data['subjects_exist_or_not'] = $subjects;
            $subjects_info = Subject::get();
            $data['subjects_info'] = $subjects_info;
            return view('admin.userCRUD.create', $data);
        }
        elseif($userTypeValidation->user_type == UserType::Student)
        {
            $data['user_type'] = $userTypeValidation->user_type;
            $data['class_exist'] = Class_number::first();
            $data['section_exist'] = Section::first();
            $data['class'] = Class_number::get();
            $data['section'] = Section::get();
            return view('admin.userCRUD.create', $data);
        }
        else
        {
            flash("Creating your requested data type is not possible ")->error();
            return redirect('/admin/user');
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(userCreateValidation $userCreateValidation)
    {
        //
        if ($userCreateValidation->user_type == UserType::Teacher) {

            $current_user_id = DB::table('users')->insertGetId(
                [
                    'name' => $userCreateValidation->teacher_name,
                    'user_type' => $userCreateValidation->user_type,
                    'is_first_time_login' => true,
                    'email' => $userCreateValidation->email,
                    'password' => Hash::make("123"),
                    'created_by' => Auth::user()->id,
                    'updated_by' => Auth::user()->id
                ]
            );

            // inserting expertize subjects of teacher to the relation table 
            foreach ($userCreateValidation->subjects as $subject) {
                $rel_sub_teacher = new Rel_subjects_teacher();
                $rel_sub_teacher->teacher_id = $current_user_id;
                $rel_sub_teacher->subject_id = $subject;
                $rel_sub_teacher->created_at = Carbon::now()->toTimeString();
                $rel_sub_teacher->updated_at = Carbon::now()->toTimeString();
                $rel_sub_teacher->save();
            }

            // inserting other teacher details
            $teacher_detail = new Teacher_details();
            $teacher_detail->user_id = $current_user_id;
            $teacher_detail->contact_no = $userCreateValidation->teacher_contact;
            $teacher_detail->created_by = Auth::user()->id;
            $teacher_detail->updated_by = Auth::user()->id;
            $teacher_detail->created_at = Carbon::now()->toTimeString();
            $teacher_detail->updated_at = Carbon::now()->toTimeString();
            $teacher_detail->save();
            $this->sendMailtoUser($userCreateValidation->email);
            flash('Successfully created')->success();
            return redirect('/admin/users');
        } 
        elseif ($userCreateValidation->user_type == UserType::Student) {
            $class_exist = Class_number::where('id',$userCreateValidation->class)->first(); 
            $section_exist = Section::where('id',$userCreateValidation->section)->first();
            if($class_exist && $section_exist)
            {
                $current_user_id = DB::table('users')->insertGetId(
                    [
                        'name' => $userCreateValidation->student_name,
                        'user_type' => $userCreateValidation->user_type,
                        'is_first_time_login' => true,
                        'email' => $userCreateValidation->email,
                        'password' => Hash::make("123"),
                        'created_by' => Auth::user()->id,
                        'updated_by' => Auth::user()->id
                    ]
                );

                $student_details = new Student_details();
                $student_details->user_id = $current_user_id;
                $student_details->class_id = $userCreateValidation->class;
                $student_details->section_id = $userCreateValidation->section;
                $student_details->father_name = $userCreateValidation->father_name;
                $student_details->mother_name = $userCreateValidation->mother_name;
                $student_details->parent_contact_no = $userCreateValidation->parent_contact;
                $student_details->created_by = Auth::user()->id;
                $student_details->updated_by = Auth::user()->id;
                $student_details->created_at = Carbon::now()->toDateTimeString();
                $student_details->updated_at = Carbon::now()->toDateTimeString();
                $student_details->save();
                $this->sendMailtoUser($userCreateValidation->email);
                flash("Student Added Successfully")->success();
                return redirect('/admin/users');
            } 
            else
            {
                flash("Your given class and section doesn't exist. Couldn't create the Student.")->error();
                return redirect('/admin/users');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $user = User::find($id);
        if ($user) {
            if ($user->user_type == UserType::Teacher) {
                //Teacher
                $data['user'] = $user;
                $user_details = Teacher_details::where('user_id', $id)->first();
                // dd($user_details);
                $data['user_details'] = $user_details;
                $expertSubjects = Subject::join('rel_subjects_teachers', 'rel_subjects_teachers.subject_id', '=', 'subjects.id')->where('rel_subjects_teachers.teacher_id', $id)->get();
                $data['expert_subjects'] = "";
                $lastIndex = count($expertSubjects) - 1;
                foreach ($expertSubjects as $key => $sub) {
                    if ($key == $lastIndex) {
                        $data['expert_subjects'] = $data['expert_subjects']  . $sub->subject_name;
                    } else {
                        $data['expert_subjects']  = $data['expert_subjects'] . $sub->subject_name . ", ";
                    }
                }
                return view('admin.userCRUD.display', $data);
            } elseif ($user->user_type == UserType::Student) {
                // student
            } else {
                // admin
                $data['user'] = $user;
                return view('admin.userCRUD.display', $data);
            }
        } else {
            flash("the requested user doesn't exist")->error();
            return redirect('/admin/users');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $user = User::find($id);
        if ($user) {
            if ($user->user_type == UserType::Teacher) {
                // teacher
                $data['user'] = $user;
                $user_details = Teacher_details::where('user_id', $id)->first();
                $data['user_details'] = $user_details;
                $expertSubjects = Rel_subjects_teacher::where('teacher_id',$id)->get();
                $data['expertSubjects'] = array();
                foreach($expertSubjects as $each)
                {
                    array_push($data['expertSubjects'], $each->subject_id);
                }
                $data['subjects'] = Subject::get();
                return view('admin.userCRUD.update', $data);
            } elseif ($user->user_type == UserType::Student) {
                // student
            } else {
                // admin
                flash("updating info of this user is not possible")->error();
                return redirect('/admin/dashboard');
            }
        } else {
            flash("not such a user exists for update")->error();
            return redirect('/admin/dashboard');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(userUpdateValidation $userUpdateValidation, $id)
    {
        //
        $user = User::find($id);
        if ($user) {
            if ($user->user_type == UserType::Teacher) {
                // Teacher Update

                // users
                $user->name = $userUpdateValidation->teacher_name;
                $user->updated_by = Auth::user()->id;
                $user->updated_at = Carbon::now()->toDateTimeString();
                $sendMail = false;
                if ($userUpdateValidation->email != $user->email) {
                    $user->is_first_time_login = true;
                    $user->password = Hash::make("123");
                    $sendMail = true;
                }
                $user->email = $userUpdateValidation->email;

                // expert subject update
                Rel_subjects_teacher::where('teacher_id',$id)->delete();
                foreach($userUpdateValidation->subjects as $sub)
                {
                    $rel_sub_teacher = new Rel_subjects_teacher();
                    $rel_sub_teacher->subject_id = $sub;
                    $rel_sub_teacher->teacher_id = $id;
                    $rel_sub_teacher->created_at = Carbon::now()->toDateTimeString();
                    $rel_sub_teacher->updated_at = Carbon::now()->toDateTimeString();
                    $rel_sub_teacher->save();
                }

                // teacher details
                $user_details = Teacher_details::where('user_id', $id)->first();
                if ($user_details) {
                    $user_details->contact_no = $userUpdateValidation->teacher_contact;
                    $user_details->updated_by = Auth::user()->id;
                    $user_details->updated_at = Carbon::now()->toDateTimeString();

                    $user->save();
                    $user_details->save();

                    if ($sendMail == true) {
                        $this->sendMailtoUser($user->email);
                    }
                    flash("successfully updated")->success();
                    return redirect('/admin/users');
                } else {
                    flash("no such user exists")->error();
                    return redirect('/admin/users');
                }
            } elseif ($user->user_type == UserType::Student) {
                //student
            } else {
                flash("Not possible to update this user")->error();
                return redirect('/admin/users');
            }
        } else {
            flash("no such user exists")->error();
            return redirect('/admin/users');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $user = User::find($id);
        if ($user) {
            switch ($user->user_type) {
                case UserType::Teacher:
                    // Teacher
                    $user_detail = Teacher_details::where('user_id', $id)->first();
                    if ($user_detail) {
                        Rel_subjects_teacher::where('teacher_id',$id)->delete();
                        $user_detail->delete();
                        $user->delete();
                        flash('Deleted Successfully')->success();
                        return redirect('/admin/users');
                    } else {
                        flash("no such user exists")->error();
                        return redirect("/admin/users");
                    }
                    break;
                case UserType::Student:
                    // Student
                    break;
                default:
                    flash("Deleting this user is not possible")->error();
                    return redirect('/admin/users');
                    break;
            }
        } else {
            flash("no such user exists")->error();
            return redirect('/admin/users');
        }
    }

    public function mailSending()
    {
        $data["name"] = "sms_admin";
        $data["data"] = "sms_admin_testing";
        $user['to'] = "ds.sms.controller@gmail.com";
        Mail::send('mail', $data, function ($message) use ($user) {
            $message->to($user['to']);
            $message->subject('Testing');
        });
    }
    public function hash()
    {
        echo Hash::make("123");
    }
    public function sendMailtoUser($toAddress)
    {
        $data["email"] = $toAddress;
        $data["password"] = "123";
        $user['to'] = $toAddress;
        Mail::send('admin.userCRUD.sendMailToUser', $data, function ($message) use ($user) {
            $message->to($user['to']);
            $message->subject('Your login credentials for School_Management_system');
        });
    }
    public function allSec($class_id)
    {
        echo json_encode(Section::where('class_id',$class_id)->get());
    }
}
