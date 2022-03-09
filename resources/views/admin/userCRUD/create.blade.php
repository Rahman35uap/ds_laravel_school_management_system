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
                    <div class="form-check form-check-inline">

                        <label class="form-check-label" for="bangla">
                            <input class="form-check-input" type="checkbox" name="subjects[]" id="bangla"
                                value="bangla">Bangla
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label" for="english">
                            <input class="form-check-input" type="checkbox" name="subjects[]" id="english"
                                value="english">English
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label" for="physics">
                            <input class="form-check-input" type="checkbox" name="subjects[]" id="physics"
                                value="physics">Physics
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label" for="chemistry">
                            <input class="form-check-input" type="checkbox" name="subjects[]" id="chemistry"
                                value="chemistry">Chemistry
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label" for="biology">
                            <input class="form-check-input" type="checkbox" name="subjects[]" id="biology"
                                value="biology">Biology
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label" for="accounting">
                            <input class="form-check-input" type="checkbox" name="subjects[]" id="accounting"
                                value="accounting">Accounting
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label" for="finance">
                            <input class="form-check-input" type="checkbox" name="subjects[]" id="finance"
                                value="finance">Finance
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label" for="business">
                            <input class="form-check-input" type="checkbox" name="subjects[]" id="business"
                                value="business">Business Ent.
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label" for="economics">
                            <input class="form-check-input" type="checkbox" name="subjects[]" id="economics"
                                value="economics">Economics
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label" for="civics">
                            <input class="form-check-input" type="checkbox" name="subjects[]" id="civics"
                                value="civics">Civics
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label" for="geography">
                            <input class="form-check-input" type="checkbox" name="subjects[]" id="geography"
                                value="geography">Geography
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label" for="math">
                            <input class="form-check-input" type="checkbox" name="subjects[]" id="math"
                                value="math">Math
                        </label>
                    </div>

                    <div class="form-check form-check-inline">
                        <label class="form-check-label" for="ss">
                            <input class="form-check-input" type="checkbox" name="subjects[]" id="ss"
                                value="social science">Social Science
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label" for="ir">
                            <input class="form-check-input" type="checkbox" name="subjects[]" id="ir"
                                value="islamic religion">Islamic Religion
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label" for="or">
                            <input class="form-check-input" type="checkbox" name="subjects[]" id="or"
                                value="other religion">Other Religion
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label" for="ict">
                            <input class="form-check-input" type="checkbox" name="subjects[]" id="ict" value="ict">ICT
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label" for="gs">
                            <input class="form-check-input" type="checkbox" name="subjects[]" id="gs"
                                value="general science">General Science
                        </label>
                    </div>
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
        <h3>Create a new Student</h3>
        @endif
    </div>
</div>
@endsection
