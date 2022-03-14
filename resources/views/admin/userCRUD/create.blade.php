@extends('admin.layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        @if ($user_type == 1)
        <h3>Create a new Teacher</h3>
        @else
        <h3>Create a new Student</h3>
        @endif
    </div>
    <div class="card-body">
        @if ($user_type == 1)
        @if ($subjects_exist_or_not)
        <form class="form-horizontal" action="{{ url('/admin/users') }}" method="POST">
            @csrf
            <div class="form-group">
                <input type="hidden" value="{{ $user_type }}" name="user_type">
                <label class="control-label col-sm-2">Teacher Name:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" value="{{ old('teacher_name') }}" placeholder="Teacher Name"
                        name="teacher_name">
                </div>
                <label class="control-label col-sm-2">Email Address:</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" value="{{ old('email') }}" placeholder="Email"
                        name="email">
                </div>
                <label class="control-label col-sm-2">Expertize At Following Subjects:</label>
                <div class="col-sm-10">
                    @foreach ($subjects_info as $subject)
                    <div class="form-check form-check-inline">
                        <label class="form-check-label" for="{{$subject->id}}">
                            <input class="form-check-input" type="checkbox" name="subjects[]" id="{{$subject->id}}"
                                value="{{ $subject->id }}"
                                {{ (is_array(old('subjects')) && in_array($subject->id,old('subjects')))? "checked" : "" }}>{{$subject->subject_name}}
                        </label>
                    </div>
                    @endforeach
                </div>

                <label class="control-label col-sm-2">Teacher Contact Number:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" value="{{ old('teacher_contact') }}"
                        placeholder="Teacher Contact" name="teacher_contact">
                </div>
            </div>
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">ADD</button>
            </div>
        </form>
        @else
        <h2>There are no subjects.You have to create Subjects first</h2>
        <a href="{{ url("/admin/subjects") }}" class="btn btn-success btn-sm">Create Subject</a>
        @endif
        @else
        @if ($class_exist)
        @if ($section_exist)
        {{-- create student --}}
        <form class="form-horizontal" action="{{ url('/admin/users') }}" method="POST">
            @csrf
            <div class="form-group">
                <input type="hidden" value="{{ $user_type }}" name="user_type">
                <label class="control-label col-sm-2">Student Name:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" value="{{ old('student_name') }}" placeholder="Student Name"
                        name="student_name">
                </div>
                <label class="control-label col-sm-2">Email Address:</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" value="{{ old('email') }}" placeholder="Email"
                        name="email">
                </div>
                <label class="control-label col-sm-2">Class:</label>
                <div class="col-sm-10">
                    <select name="class" id="class_id">
                        @foreach ($class as $item)
                        <option value="{{ $item->id }}">{{ $item->class }}</option>
                        @endforeach
                    </select>
                </div>
                <label class="control-label col-sm-2">Section:</label>
                <div class="col-sm-10">
                    <select name="section" id="section_id">

                    </select>
                </div>
                <label class="control-label col-sm-2">Father's Name:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" value="{{ old('father_name') }}" placeholder="Father's Name"
                        name="father_name">
                </div>
                <label class="control-label col-sm-2">Mother's Name:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" value="{{ old('mother_name') }}" placeholder="Mother's Name"
                        name="mother_name">
                </div>

                <label class="control-label col-sm-2">Parent Contact Number:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" value="{{ old('parent_contact') }}"
                        placeholder="Parent Contact" name="parent_contact">
                </div>
            </div>
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">ADD</button>
            </div>
        </form>
        @else
        <h2>There are no section.You have to create Section first</h2>
        <a href="{{ url("/admin/section") }}" class="btn btn-success btn-sm">Create Section</a>
        @endif
        @else
        <h2>There are no class.You have to create Class first</h2>
        <a href="{{ url("/admin/class") }}" class="btn btn-success btn-sm">Create Class</a>
        @endif
        @endif
    </div>
</div>
@endsection

@push('scripts')

<script>
    $(document).ready(function () {
        $('#class_id').on('change', function () {
            var classId = $(this).val();
            $('#section_id').empty();
            $.ajax({
                type: 'GET',
                url: '/admin/allSec/' + classId,
                success: function (response) {
                    var response = JSON.parse(response);
                    console.log(response);
                    $('#section_id').empty();
                    response.forEach(element => {
                        $('#section_id').append('<option value="' + element['id'] +
                        '">' + element['name'] + '</option>');
                        // console.log(element['id']);
                    });
                }
            });
        });
        $(window).on('load', function () {
            var classId = $('#class_id').val();
            $('#section_id').empty();
            $.ajax({
                type: 'GET',
                url: '/admin/allSec/' + classId,
                success: function (response) {
                    var response = JSON.parse(response);
                    console.log(response);
                    $('#section_id').empty();
                    response.forEach(element => {
                        $('#section_id').append('<option value="' + element['id'] +
                            '">' + element['name'] + '</option>');
                        // console.log(element['id']);
                    });
                }
            });
        });
    });

</script>
@endpush
