@extends('admin.layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Create a new Class</h3>
    </div>
    <div class="card-body">
        @if (!$subjects_exists_or_not)
            <h4>First you have to create subjects</h4>
            <a href="{{ url("/admin/subjects") }}" class="btn btn-success btn-sm">Create Subject</a>
        @else
        <form class="form-horizontal" action="{{ url('/admin/class') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="control-label col-sm-2">Class Number:</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" value="{{ old('class_number') }}"
                        placeholder="Class Number" name="class_number">
                </div>
                {{-- <label class="control-label col-sm-2">Section:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" value="{{ old('section') }}"
                        placeholder="Section of the class" name="section">
                </div> --}}
                <label class="control-label col-sm-2">Has Following Subjects:</label>
                <div class="col-sm-10">
                    @foreach ($subjects as $subject)
                    <div class="form-check form-check-inline">
                        <label class="form-check-label" for="{{$subject->id}}">
                            <input class="form-check-input" type="checkbox" name="subjects[]" id="{{$subject->id}}"
                                value="{{ $subject->id }}">{{$subject->subject_name}}
                        </label>
                    </div>
                    @endforeach
                </div>
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default">ADD</button>
                </div>
        </form>
        @endif

    </div>
</div>
@endsection
