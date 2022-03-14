<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Class_number;
use App\Models\Section;
use Illuminate\Http\Request;

class SecController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['class'] = Class_number::get();
        $data['section'] = Section::get();
        $data['class_with_section'] = Class_number::join('sections','class_numbers.id','=','sections.class_id')->get(['class_numbers.class','sections.name','sections.id']);
        return view('admin.secCRUD.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data['class'] = Class_number::get();
        $data['class_exists_or_not'] = (!Class_number::first())?true:false;
        // dd($data['class']);
        return view('admin.secCRUD.create', $data);
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
            'class_number' => 'required',
            'section' => 'required'
        ]);
        $section = Section::where('name',$request->section)->where('class_id',$request->class_number)->first();
        if(!$section)
        {
            $section = new Section();
            $section->name = $request->section;
            $section->class_id = $request->class_number;
            $section->save();
            flash("Added Successfully")->success();
            return redirect('/admin/section');
        }
        else
        {
            flash("your requested section with given class already exists. You can't insert a new section with this class name.Either you have to delete or update it.")->error();
            return redirect('/admin/section');
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
        $section = Section::find($id);
        $class = Class_number::get();
        if($section)
        {
            $data['section'] = $section;
            $data['class'] = $class;
            return view('admin.secCRUD.update',$data);
        }
        else
        {
            flash("No such section exists")->error();
            return redirect('/admin/section');
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
            'class_number' => 'required',
            'section' => 'required'
        ]);
        $section = Section::find($id);
        if($section)
        {
            $section = Section::where('name',$request->section)->where('class_id',$request->class_number)->first();
            if(!$section)
            {
                // if the given section with given class doesn't exist then will update the class
                $section = Section::find($id);
                $section->name = $request->section;
                $section->class_id = $request->class_number;
                $section->save();

                flash("Updated Successfully")->success();
                return redirect('/admin/section');
            }
            $section = Section::where('name', $request->section)->where('class_id', $request->class_number)->find($id);
            if($section)
            {
                // if the given section with given class exists and that's id is equal to the requested id then will update the section otherwise not

                $section->name = $request->section;
                $section->class_id = $request->class_number;
                $section->save();

                flash("Updated Successfully")->success();
                return redirect('/admin/section');

            }
            else
            {
                flash("you can't give two different section same name. Your given section name with given class already exists .")->error();
                return redirect('/admin/section');
            }
        }
        else
        {
            flash("No such section exists")->error();
            return redirect('/admin/section');
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
    }
}
