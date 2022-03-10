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
                    <div class="form-check form-check-inline">

                        <label class="form-check-label" for="bangla">
                            <input class="form-check-input" type="checkbox" name="subjects[]" id="bangla"
                                value="bangla" {{ (in_array("bangla",$expertize)) ? "checked" : "" }}>Bangla
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label" for="english">
                            <input class="form-check-input" type="checkbox" name="subjects[]" id="english"
                                value="english" {{ (in_array("english",$expertize)) ? "checked" : "" }}>English
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label" for="physics">
                            <input class="form-check-input" type="checkbox" name="subjects[]" id="physics"
                                value="physics" {{ (in_array("physics",$expertize)) ? "checked" : "" }}>Physics
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label" for="chemistry">
                            <input class="form-check-input" type="checkbox" name="subjects[]" id="chemistry"
                                value="chemistry" {{ (in_array("chemistry",$expertize)) ? "checked" : "" }}>Chemistry
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label" for="biology">
                            <input class="form-check-input" type="checkbox" name="subjects[]" id="biology"
                                value="biology" {{ (in_array("biology",$expertize)) ? "checked" : "" }}>Biology
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label" for="accounting">
                            <input class="form-check-input" type="checkbox" name="subjects[]" id="accounting"
                                value="accounting" {{ (in_array("accounting",$expertize)) ? "checked" : "" }}>Accounting
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label" for="finance">
                            <input class="form-check-input" type="checkbox" name="subjects[]" id="finance"
                                value="finance" {{ (in_array("finance",$expertize)) ? "checked" : "" }}>Finance
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label" for="business">
                            <input class="form-check-input" type="checkbox" name="subjects[]" id="business"
                                value="business" {{ (in_array("business",$expertize)) ? "checked" : "" }}>Business Ent.
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label" for="economics">
                            <input class="form-check-input" type="checkbox" name="subjects[]" id="economics"
                                value="economics" {{ (in_array("economics",$expertize)) ? "checked" : "" }}>Economics
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label" for="civics">
                            <input class="form-check-input" type="checkbox" name="subjects[]" id="civics"
                                value="civics" {{ (in_array("civics",$expertize)) ? "checked" : "" }}>Civics
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label" for="geography">
                            <input class="form-check-input" type="checkbox" name="subjects[]" id="geography"
                                value="geography" {{ (in_array("geography",$expertize)) ? "checked" : "" }}>Geography
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label" for="math">
                            <input class="form-check-input" type="checkbox" name="subjects[]" id="math"
                                value="math" {{ (in_array("math",$expertize)) ? "checked" : "" }}>Math
                        </label>
                    </div>

                    <div class="form-check form-check-inline">
                        <label class="form-check-label" for="ss">
                            <input class="form-check-input" type="checkbox" name="subjects[]" id="ss"
                                value="social science"
                                {{ (in_array("social science",$expertize)) ? "checked" : "" }}>Social Science
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label" for="ir">
                            <input class="form-check-input" type="checkbox" name="subjects[]" id="ir"
                                value="islamic religion"
                                {{ (in_array("islamic religion",$expertize)) ? "checked" : "" }}>Islamic Religion
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label" for="or">
                            <input class="form-check-input" type="checkbox" name="subjects[]" id="or"
                                value="other religion"
                                {{ (in_array("other religion",$expertize)) ? "checked" : "" }}>Other Religion
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label" for="ict">
                            <input class="form-check-input" type="checkbox" name="subjects[]" id="ict" value="ict"
                                {{ (in_array("ict",$expertize)) ? "checked" : "" }}>ICT
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label" for="gs">
                            <input class="form-check-input" type="checkbox" name="subjects[]" id="gs"
                                value="general science"
                                {{ (in_array("general science",$expertize)) ? "checked" : "" }}>General Science
                        </label>
                    </div>
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
