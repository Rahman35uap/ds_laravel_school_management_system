@extends('admin.layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        @if ($user->user_type == 1)
        <h3>Create a new Teacher</h3>
        @else
        <h3>Create a new Student</h3>
        @endif
    </div>
    <div class="card-body">
        @if ($user->user_type == 1)
        <form class="form-horizontal" action="{{ url("/admin/users/$user->id") }}" method="POST">
            @method('put')
            @csrf
            <div class="form-group">
                <input type="hidden" value="{{ $user->user_type }}" name="user_type">
                <label class="control-label col-sm-2">Teacher Name:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" value="{{ $user->name}}" placeholder="Teacher Name"
                        name="teacher_name">
                </div>
                <label class="control-label col-sm-2">Teacher Email Address:</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" value="{{ $user->email }}" placeholder="Email"
                        name="email">
                </div>
                <label class="control-label col-sm-2">Expertize At Following Subjects:</label>
                <div class="col-sm-10">
                    @foreach ($subjects as $subject)
                    <div class="form-check form-check-inline">
                        <label class="form-check-label" for="{{$subject->id}}">
                            <input class="form-check-input" type="checkbox" name="subjects[]" id="{{$subject->id}}"
                                value="{{ $subject->id }}"
                                {{ ( in_array($subject->id,$expertSubjects))? "checked" : "" }}>{{$subject->subject_name}}
                        </label>
                    </div>
                    @endforeach
                </div>

                <label class="control-label col-sm-2">Teacher Contact Number:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" value="{{ $user_details->contact_no }}"
                        placeholder="Teacher Contact" name="teacher_contact">
                </div>
            </div>
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">Update</button>
            </div>
        </form>

        @else
        <h3>Create a new Student</h3>
        @endif
    </div>
</div>
@endsection
