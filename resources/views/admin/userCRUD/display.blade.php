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

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Teacher Name</th>
                    <th>Email Address</th>
                    <th>Expert At Following Subjects</th>
                    <th>Teacher Contact Number</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $expert_subjects }}</td>
                    <td>{{ $user_details->contact_no }}</td>
                </tr>
            </tbody>
        </table>

        @elseif($user->user_type == 2)
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Student Name</th>
                        <th>Student ID</th>
                        <th>User Type</th>
                        <th>Class Name</th>
                        <th>Section Name</th>
                        <th>Father Name</th>
                        <th>Mother Name</th>
                        <th>Parent Contact</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->id }}</td>
                        <td>{{ App\Enums\UserType::getDescription($user->user_type) }}</td>
                        <td>{{ $class_details->class }}</td>
                        <td>{{ $section_details->name }}</td>
                        <td>{{ $student_details->father_name }}</td>
                        <td>{{ $student_details->mother_name }}</td>
                        <td>{{ $student_details->parent_contact_no }}</td>
                    </tr>
                </tbody>
            </table>
        @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Admin Name:</th>
                    <th>Admin Email Address:</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                </tr>
            </tbody>
        </table>
        @endif
    </div>
</div>
@endsection
