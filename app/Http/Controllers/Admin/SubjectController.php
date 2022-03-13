<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['subjects'] = Subject::get();
        // dd($data['subjects']);
        return view('admin.subjectCRUD.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.subjectCRUD.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'subject_name' => 'required'
         ]);
         
         $subject = new Subject();
         $subject->subject_name = $request->subject_name;
         $subject->save();
         flash("Your subject has been added successfully")->success();
         return redirect('/admin/subjects');
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
        $subject = Subject::find($id);
        if($subject)
        {
            $data['subject'] = $subject;
            return view('admin.subjectCRUD.update',$data);
        }
        else
        {
            flash("no such subject exists")->error();
            return redirect('/admin/subjects');
        }
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
        $this->validate($request, [
            'subject_name' => 'required'
         ]);
         $subject = Subject::find($id);
         if($subject)
         {
            $subject->subject_name = $request->subject_name;
            $subject->save();
            flash("updated successfully")->success();
            return redirect('/admin/subjects');
         }
         else
         {
            flash("no such subject exists")->error();
            return redirect('/admin/subjects');
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
        $subject = Subject::find($id);
        if($subject)
        {
            $subject->delete();
            flash("deleted successfully")->success();
            return redirect('admin/subjects');
        }
        else
        {
            flash("no such subject exists")->error();
            return redirect('/admin/subjects');
        }
    }
}
