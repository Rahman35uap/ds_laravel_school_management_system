@extends('admin.layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Admin DashBoard</h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Menu</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><a href="{{ url("/admin/subjects") }}">Subjects</a></td>
                </tr>
                <tr>
                    <td><a href="{{ url("/admin/class") }}">Class</a></td>
                </tr>
                <tr>
                    <td><a href="{{ url("/admin/section") }}">Section</a></td>
                </tr>
                <tr>
                    <td><a href="{{ url("/admin/users") }}">User</a></td>
                </tr>
                <tr>
                    <td><a href="#">Routine</a></td>
                </tr>
                <tr>
                    <td><a href="#">Exam</a></td>
                </tr>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        Footer
    </div>
    <!-- /.card-footer-->
</div>
@endsection