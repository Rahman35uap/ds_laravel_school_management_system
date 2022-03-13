@extends('admin.layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>details of class [{{ $class_name }}]</h3>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name of Class</th>
                    <th>Subjects of this class</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $class_name }}</td>
                    <td>
                        @foreach ($subjects_name as $subject)
                            {{ $subject->subject_name }}
                            <br>
                        @endforeach                      
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
