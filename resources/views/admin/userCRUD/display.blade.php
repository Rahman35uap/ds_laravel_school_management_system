@extends('admin.layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        @if ($user->user_type == 1)
            <h3>Teacher Details</h3>
        @elseif ($user->user_type == 2)
            <h3>Student Details</h3>
        @else
            <h3>Admin Details</h3>
        @endif
    </div>
    <div class="card-body">
        @if ($user->user_type == 1)
            <div class="form-group">
                <label class="control-label col-sm-2">Teacher Name:</label>
                <div class="col-sm-10">
                    <text class="form-control" name="teacher_name"/>{{ $user->name }}       
                </div>
                <label class="control-label col-sm-2">Email Address:</label>
                <div class="col-sm-10">
                    <text class="form-control" name="email" />{{ $user->email }}
                </div>
                <label class="control-label col-sm-2">Expertize At Following Subjects:</label>
                <div class="col-sm-10">
                    <textarea class="form-control" name="teacher_name">{{ implode("\n", json_decode($user_details->subjects_expertize_at)) }}</textarea>
                </div>

                <label class="control-label col-sm-2">Teacher Contact Number:</label>
                <div class="col-sm-10">
                    <text class="form-control" name="teacher_contact"/>{{ $user_details->contact_no }}
                </div>
            </div>

        @elseif($user->user_type == 2)
            <h3>Create a new Student</h3>
        @else
            <div class="form-group">
                <label class="control-label col-sm-2">Admin Name:</label>
                <div class="col-sm-10">
                    <text class="form-control" />{{ $user->name }}
                </div>
                <label class="control-label col-sm-2">Admin Email Address:</label>
                <div class="col-sm-10">
                    <text class="form-control" />{{ $user->email }}
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
