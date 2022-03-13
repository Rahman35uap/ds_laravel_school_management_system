@extends('admin.layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">List of all class with section in the school</h3>
    </div>
    <div class="card-body">
        <form action="{{ url("/admin/section/create") }}" method="GET">
            @csrf
            <button type="submit" class="btn btn-success">Add New Section</button>
        </form>
        <hr>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name of Class</th>
                    <th>Name of Section</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($class_with_section as $eachClass_with_section)
                <tr>
                    <td>{{ $eachClass_with_section->class }}</td>
                    <td>{{ $eachClass_with_section->name }}</td>
                    <td>
                        {{-- <a href="{{ url("/admin/class/{$eachClass->id}") }}" class="btn btn-success btn-sm">Show</a> --}}
                        <a href="{{ url("/admin/section/{$eachClass_with_section->id}/edit") }}" class="btn btn-warning btn-sm">Update</a>
                        <form action="{{ url("/admin/section/$eachClass_with_section->id") }}" method="POST"
                            onsubmit="return confirm('Do you want to delete this Class?');">
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
