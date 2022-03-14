<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\User_Create\firstTimeLoginPasswordValidation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StudentDashboardController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('student.dashboard.index');
    }
    public function firstTimeLogin()
    {
        # code...
        return view('student.dashboard.firstTimeLogin');
    }
    public function passwordUpdate(firstTimeLoginPasswordValidation $firstTimeLoginPasswordValidation)
    {

        if($firstTimeLoginPasswordValidation->new_pass == $firstTimeLoginPasswordValidation->confirm_pass)
        {
            $user = User::find(Auth::user()->id);
            if(!$user)
            {
                return redirect('/');
            }
            $user->password = Hash::make( $firstTimeLoginPasswordValidation->new_pass);
            $user->updated_by = Auth::user()->id;
            $user->is_first_time_login = false;
            $user->email_verified_at = Carbon::now()->toDateTimeString();
            $user->save();
            flash("Your password has been changed successfully")->success();
            return redirect('/student/dashboard');
        }
        else
        {
            flash("Your new password and confirm password have to be same")->error();
            return redirect('/student/firstTimeLogin');
        }
    }
}
