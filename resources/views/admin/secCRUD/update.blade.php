@extends('admin.layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Update class</h3>
    </div>
    <div class="card-body">
        <form class="form-horizontal" action="{{ url("/admin/section/$section->id") }}" method="POST">
            @method('put')
            @csrf
            <div class="form-group">
                <label class="control-label col-sm-2">Class Number:</label>
                <div class="col-sm-10">
                    <select class="form-control" name="class_number">
                        @foreach ($class as $eachClass)
                        <option value="{{ $eachClass->id }}" {{ ($eachClass->id == $section->class_id)?"selected":"" }}>{{ $eachClass->class }}</option>
                        @endforeach
                    </select>
                </div>
                <label class="control-label col-sm-2">Section:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" value="{{ $section->name }}"
                        placeholder="Section of the class" name="section">
                </div>
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default">ADD</button>
                </div>
        </form>
    </div>
</div>
@endsection
