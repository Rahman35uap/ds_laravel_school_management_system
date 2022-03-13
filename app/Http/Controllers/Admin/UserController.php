<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\User_Create\userCreateValidation;
use App\Http\Requests\User_Create\userTypeValidation;
use App\Http\Requests\User_Create\userUpdateValidation;
use App\Models\Teacher_details;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Enum;
use Mail;

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
        return view('admin.userCRUD.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(userTypeValidation $userTypeValidation)
    {
        //
        $data['user_type'] = $userTypeValidation->user_type;
        return view('admin.userCRUD.create',$data);
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
        $subjects = json_encode($userCreateValidation->subjects);
        $current_user_id = DB::table('users')->insertGetId(
            ['name'=>$userCreateValidation->teacher_name,
            'user_type'=>$userCreateValidation->user_type,
            'is_first_time_login'=>true,
            'email' => $userCreateValidation->email, 
            'password' => Hash::make("123"),
            'created_by' => Auth::user()->id,
            'updated_by' => Auth::user()->id
            ]
        );
        
        $teacher_detail = new Teacher_details();
        $teacher_detail->user_id = $current_user_id;
        $teacher_detail->subjects_expertize_at = $subjects;
        $teacher_detail->contact_no = $userCreateValidation->teacher_contact;
        $teacher_detail->created_by = Auth::user()->id;
        $teacher_detail->updated_by = Auth::user()->id;
        $teacher_detail->save();
        $this->sendMailtoUser($userCreateValidation->email);
        flash('Successfully created')->success();
        return redirect('/admin/users');
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
        if($user)
        {
            if($user->user_type == 1)
            {
                //Teacher
                $data['user'] = $user;
                $user_details = Teacher_details::where('user_id',$id)->first();
                // dd($user_details);
                $data['user_details'] = $user_details;
                return view('admin.userCRUD.display', $data);

            }
            elseif($user->user_type == 2)
            {
                // student
            }
            else
            {
                // admin
                $data['user'] = $user;
                return view('admin.userCRUD.display', $data);
            }
        }
        else
        {
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
        if($user)
        {
            if($user->user_type == 1)
            {
                // teacher
                $data['user'] = $user;
                $user_details = Teacher_details::where('user_id', $id)->first();
                $data['user_details'] = $user_details;
                $data['expertize'] = json_decode($user_details->subjects_expertize_at);
            return view('admin.userCRUD.update',$data);
            }
            elseif($user->user_type == 2)
            {
                // student
            }
            else
            {
                // admin
                flash("updating info of this user is not possible")->error();
                return redirect('/admin/dashboard');
            }
        }
        else
        {
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
        if($user)
        {
            if($user->user_type == 1)
            {
                // Teacher Update

                // users
                $user->name = $userUpdateValidation->teacher_name;
                $user->updated_by = Auth::user()->id;
                $user->updated_at = Carbon::now()->toDateTimeString();
                $sendMail = false;
                if($userUpdateValidation->email != $user->email)
                {
                    $user->is_first_time_login = true;
                    $user->password = Hash::make("123");
                    $sendMail = true;
                }
                $user->email = $userUpdateValidation->email;
                

                // teacher details
                $user_details = Teacher_details::where('user_id',$id)->first();
                if($user_details)
                {
                    $user_details->subjects_expertize_at = json_encode($userUpdateValidation->subjects);
                    $user_details->contact_no = $userUpdateValidation->teacher_contact;
                    $user_details->updated_by = Auth::user()->id;
                    $user_details->updated_at = Carbon::now()->toDateTimeString();

                    $user->save();
                    $user_details->save();
                    
                    if ($sendMail == true) 
                    {
                        $this->sendMailtoUser($user->email);
                    }
                    flash("successfully updated")->success();
                    return redirect('/admin/users');
                }
                else
                {
                    flash("no such user exists")->error();
                    return redirect('/admin/users');
                }
            }
            elseif($user->user_type == 2)
            {
                //student
            }
            else
            {
                flash("Not possible to update this user")->error();
                return redirect('/admin/users');
            }
        }
        else
        {
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
        if($user)
        {
            switch($user->user_type)
            {
                case 1:
                    // Teacher
                    $user_detail = Teacher_details::where('user_id',$id)->first();
                    if($user_detail)
                    {
                        $user_detail->delete();
                        $user->delete();
                        flash('Deleted Successfully')->success();
                        return redirect('/admin/users');
                    }
                    else
                    {
                        flash("no such user exists")->error();
                        return redirect("/admin/users");
                    }
                    break;
                case 2:
                    // Student
                    break;
                default:
                    flash("Deleting this user is not possible")->error();
                    return redirect('/admin/users');
                    break;
            }
        
        }
        else
        {
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
}
