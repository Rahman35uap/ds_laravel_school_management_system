@extends('teacher.layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">You have to change your password</h3>
    </div>
    <div class="card-body">
        <form class="form-horizontal" action="{{ url('/teacher/firstTimeLogin/passwordUpdate') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="control-label col-sm-2">Your New Password:</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" value="{{ old('new_pass') }}" placeholder="Enter your new Password"
                        name="new_pass">
                </div>
                <label class="control-label col-sm-2">Confirm Password:</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" value="{{ old('confirm_pass') }}" placeholder="Confirm your new Password"
                        name="confirm_pass">
                </div>
            </div>
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">Change Password</button>
            </div>
        </form>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        Footer
    </div>
    <!-- /.card-footer-->
</div>
@endsection