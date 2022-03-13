@extends('admin.layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Update Subject</h3>
    </div>
    <div class="card-body">
        <form class="form-horizontal" action="{{ url("/admin/subjects/$subject->id") }}" method="POST">
            @method('put')
            @csrf
            <div class="form-group">
                <label class="control-label col-sm-2">Subject Name:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" value="{{ $subject->subject_name}}" placeholder="Subject Name"
                        name="subject_name">
                </div>
            </div>
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">Update</button>
            </div>
        </form>
    </div>
</div>
@endsection
