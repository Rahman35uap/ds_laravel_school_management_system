@extends('admin.layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Create a new Section</h3>
    </div>
    <div class="card-body">
        @if ($class_exists_or_not)
            <h4>First you have to create class</h4>
            <a href="{{ url("/admin/class") }}" class="btn btn-success btn-sm">Create Class</a>
        @else
        <form class="form-horizontal" action="{{ url('/admin/section') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="control-label col-sm-2">Class Number:</label>
                <div class="col-sm-10">
                    <select class="form-control" name="class_number">
                        @foreach ($class as $eachClass)
                            <option value="{{ $eachClass->id }}">{{ $eachClass->class }}</option>
                        @endforeach
                    </select>
                </div>
                <label class="control-label col-sm-2">Section:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" value="{{ old('section') }}"
                        placeholder="Section of the class" name="section">
                </div>
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default">ADD</button>
                </div>
        </form>
        @endif

    </div>
</div>
@endsection
