<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\User_Create\userCreateValidation;
use App\Http\Requests\User_Create\userTypeValidation;
use App\Models\Teacher_Detail;
use App\Models\User;
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
        $teacher_detail = new Teacher_Detail();
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
