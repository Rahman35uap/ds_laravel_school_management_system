@extends('admin.layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">List of all subjects in the school</h3>
    </div>
    <div class="card-body">
        <form action="{{ url("/admin/subjects/create") }}" method="GET">
            @csrf
            <button type="submit" class="btn btn-success">Add New Subject</button>
        </form>
        <hr>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name of Subject</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($subjects as $subject)
                <tr>
                    <td>{{ $subject->subject_name }}</td>
                    <td>
                        {{-- <a href="{{ url("/admin/subjects/{$subject->id}") }}" class="btn btn-success btn-sm">Show</a> --}}
                        <a href="{{ url("/admin/subjects/{$subject->id}/edit") }}" class="btn btn-warning btn-sm">Update</a>
                        <form action="{{ url("/admin/subjects/$subject->id") }}" method="POST"
                            onsubmit="return confirm('Do you want to delete this subject?');">
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
