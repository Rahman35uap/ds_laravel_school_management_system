@extends('admin.layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Create a new Subject</h3>
    </div>
    <div class="card-body">
        <form class="form-horizontal" action="{{ url('/admin/subjects') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="control-label col-sm-2">Subject Name:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" value="{{ old('subject_name') }}" placeholder="Subject Name"
                        name="subject_name">
                </div>
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">ADD</button>
            </div>
        </form>
    </div>
</div>
@endsection
