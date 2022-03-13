@extends('admin.layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Update class</h3>
    </div>
    <div class="card-body">
        <form class="form-horizontal" action="{{ url("/admin/class/$class->id") }}" method="POST">
            @method('put')
            @csrf
            <div class="form-group">
                <label class="control-label col-sm-2">class Number:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" value="{{ $class->class}}" placeholder="class Name"
                        name="class_number">
                </div>
                {{-- <label class="control-label col-sm-2">Section:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" value="{{ $class->section}}" placeholder="section"
                        name="section">
                </div> --}}
                <label class="control-label col-sm-2">Has Following Subjects:</label>
                <div class="col-sm-10">
                    @foreach ($subjects_info as $subject)
                        <div class="form-check form-check-inline">
                            <label class="form-check-label" for="{{$subject->id}}">
                                <input class="form-check-input" type="checkbox" name="subjects[]" id="{{$subject->id}}"
                                    value="{{ $subject->id }}" {{ (in_array($subject->id,$included_sub_id)) ? "checked" : "" }}>{{$subject->subject_name}}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">Update</button>
            </div>
        </form>
    </div>
</div>
@endsection
