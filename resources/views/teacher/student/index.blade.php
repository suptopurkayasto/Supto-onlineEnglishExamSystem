@extends('layouts.teacher')

@section('title', 'All Students')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Show All Students</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table border-0 table-striped table-hover custom-table-style">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Group</th>
                    <th>Section</th>
                    <th>ID Number</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($students as $index => $student)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td title="{{ $student->name }}">{{ Str::limit($student->name, 20) }}</td>
                        <td title="{{ 'Group: ' . $student->group->name }}">{{ $student->group->name }}</td>
                        <td title="{{ 'Section: ' . $student->section->name }}">{{ $student->section->name }}</td>
                        <td title="{{ 'ID Number: ' . $student->id_number }}">{{ $student->id_number }}</td>
                        <td title="{{ $student->email }}">{{ Str::limit($student->email, 30) }}</td>
                        <td class="text-center">
                            <a href="{{ route('teacher.students.show', $student->id_number) }}" class="btn btn-primary btn-sm btn-block btn-hover-effect">View</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
@endsection
