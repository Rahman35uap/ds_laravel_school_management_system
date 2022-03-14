<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Class_number;
use App\Models\Rel_class_subjects;
use App\Models\Subject;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClassController extends Controller
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
        return view('admin.classCRUD.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data["subjects"] = Subject::get();
        $data["subjects_exists_or_not"] = Subject::get()->first();
        // dd($data);
        return view('admin.classCRUD.create', $data);
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
            'subjects' => 'required'
        ]);

        $class = Class_number::where('class', $request->class_number)->first();
        if (!$class) {
            $current_class_id = DB::table('class_numbers')->insertGetId([
                'class' => $request->class_number,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ]);
            foreach ($request->subjects as $subject) {
                DB::table('rel_class_subjects')->insertGetId([
                    'class_id' => $current_class_id,
                    'subject_id' => $subject,
                    'created_at' => Carbon::now()->toDateTimeString(),
                    'updated_at' => Carbon::now()->toDateTimeString()
                ]);
            }
            flash("Added Successfully")->success();
            return redirect('/admin/class');
        } else {
            flash("your requested class already exists. You can't insert a new one with this [class name].Either you have to delete or update it.")->error();
            return redirect('/admin/class');
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
        $class = Class_number::find($id);
        if ($class) {
            $subjects_id = Class_number::join('rel_class_subjects', 'class_numbers.id', '=', "rel_class_subjects.class_id")->where('class_numbers.id','=',$id)->get("rel_class_subjects.subject_id");
            $subjects_name = Subject::whereIn('id', $subjects_id)->get("subject_name");
            $data['subjects_name'] = $subjects_name;
            $data['class_name'] = $class->class;
            return view('admin.classCRUD.display', $data);
        } else {
            flash("no such class exists.")->error();
            return redirect("/admin/class");
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
        $class = Class_number::find($id);
        if ($class) {
            $data['class'] = $class;
            $data['subjects_info'] = Subject::get();
            $data['included_sub_id'] = array();
            foreach (Rel_class_subjects::where('class_id', $id)->get('subject_id') as $item) {
                array_push($data['included_sub_id'], $item->subject_id);
            }
            // dd($data['included_sub_id']);
            return view('admin.classCRUD.update', $data);
        } else {
            flash("no such class exists")->error();
            return redirect('/admin/class');
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
            'subjects' => 'required'
        ]);
        if (Class_number::find($id))   // if the requested class exists
        {
            $class = Class_number::where('class', $request->class_number)->first();
            if (!$class) {
                // if the given class doesn't exist then will update the class


                //updating the class info
                $class = Class_number::find($id);
                $class->class = $request->class_number;
                $class->save();

                // delete the all subjects of this class from relation table
                Rel_class_subjects::where('class_id', $id)->delete();

                //inserting given all subjects of this class to relation table
                foreach ($request->subjects as $subject) {
                    $rel_class_subjects = new Rel_class_subjects();
                    $rel_class_subjects->class_id = $id;
                    $rel_class_subjects->subject_id = $subject;
                    $rel_class_subjects->save();
                }

                flash("Updated Successfully")->success();
                return redirect('/admin/class');
            }
            $class = Class_number::where('class', $request->class_number)->find($id);
            if ($class) {
                // if the given class exists and that's id is equal to the requested id then will update the class otherwise not

                //updating the class info

                $class = Class_number::find($id);
                $class->class = $request->class_number;
                $class->save();

                // delete the all subjects of this class from relation table
                Rel_class_subjects::where('class_id', $id)->delete();

                //inserting given all subjects of this class to relation table
                foreach ($request->subjects as $subject) {
                    $rel_class_subjects = new Rel_class_subjects();
                    $rel_class_subjects->class_id = $id;
                    $rel_class_subjects->subject_id = $subject;
                    $rel_class_subjects->save();
                }

                flash("Updated Successfully")->success();
                return redirect('/admin/class');
            } else {
                flash("you can't give two different class same name. Your given class name already exists .")->error();
                return redirect('/admin/class');
            }
        } else {
            flash("no such class exists")->error();
            return redirect('/admin/class');
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
        $class = Class_number::find($id);
        if ($class) {
            // delete the all subjects of this class from relation table
            Rel_class_subjects::where('class_id',$id)->delete();

            // delete the class
            $class->delete();
            flash("deleted successfully")->success();
            return redirect('/admin/class');
        } else {
            flash("no such class exists")->error();
            return redirect('/admin/class');
        }
    }
}
