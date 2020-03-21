@extends('layouts.teacher')

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
                    <th>#</th>
                    <th>Name</th>
                    <th>ID Number</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($students as $index => $student)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->id_number }}</td>
                        <td>{{ $student->email }}</td>
                        <td class="text-center">
                            <a title="{{ 'See ' . $student->name }}"
                               href="{{ route('teacher.students.show', $student->id_number) }}" class="btn btn-primary btn-hover-effect">View</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
@endsection
