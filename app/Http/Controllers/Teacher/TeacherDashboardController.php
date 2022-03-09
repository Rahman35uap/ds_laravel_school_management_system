<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\User_Create\firstTimeLoginPasswordValidation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TeacherDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('teacher.dashboard.index');
    }


    public function firstTimeLogin()
    {
        # code...
        return view('teacher.dashboard.firstTimeLogin');
    }
    public function passwordUpdate(firstTimeLoginPasswordValidation $firstTimeLoginPasswordValidation)
    {
        # code...
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
            return redirect('/teacher/dashboard');
        }
        else
        {
            flash("Your new password and confirm password have to be same")->error();
            return redirect('/teacher/firstTimeLogin');
        }
    }
}
