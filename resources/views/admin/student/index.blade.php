@extends('layouts.admin')

@section('title', 'All Students')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Show All Students</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped table-hover">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>ID Number</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($students as $student)
                    <tr>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->id_number }}</td>
                        <td>{{ $student->email }}</td>
                        <td>
                            <a href="{{ route('admin.students.show', $student->id_number) }}" class="btn btn-primary btn-block btn-hover-effect">View</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>Name</th>
                    <th>ID Number</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
@endsection
