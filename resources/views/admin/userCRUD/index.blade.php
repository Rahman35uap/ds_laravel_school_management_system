@extends('admin.layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">List of all users in the school</h3>
    </div>
    <div class="card-body">
        <a href="{{ url('/admin/users/create') }}" class="btn btn-success">Add New User</a>
        <hr>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name of User</th>
                    <th>Email</th>
                    <th>Type of User</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users_data as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ App\Enums\UserType::getDescription($user->user_type) }}</td>
                        <td>
                            <a href="{{ url("/admin/users/{$user->id}/edit") }}" class="btn btn-warning btn-sm">Update</a>
                            <form action="{{ url("/admin/users/$user->id") }}" method="POST" onsubmit="return confirm('Do you want to delete this task?');">
                                @csrf
                                @method('delete')
                                <input type="submit" value="Delete" class="btn btn-danger btn-sm">
                            </form>
                        </td>
                    </tr>
                @endforeach
                
            </tbody>
        </table>
    </div>
</div>
@endsection