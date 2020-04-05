@extends('layouts.teacher')

@section('title', 'All Students')

@section('content')
    @if($authTeacher->students()->count() > 0)
        <div class="card">
            <div class="card-header">
                <h3 class="card-title float-left index-card-title">All Students</h3>

                <a href="{{ route('teacher.students.create') }}"
                   class="btn btn-hover-effect bg-gradient-primary float-right"><i class="fas fa-pen-alt mr-1"></i> Add Students</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example"
                       class="table table-striped table-bordered dt-responsive nowrap border-0 table-hover custom-table-style"
                       style="width: 100%">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>ID Number</th>
                        <th>Name</th>
                        <th>Group</th>
                        <th>Section</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($authTeacher->students as $index => $student)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td title="{{ 'ID Number: ' . $student->id_number }}">{{ $student->id_number }}</td>
                            <td title="{{ $student->name }}">{{ Str::limit($student->name, 20) }}</td>
                            <td title="{{ 'Group: ' . $student->group->name }}">{{ $student->group->name }}</td>
                            <td title="{{ 'Section: ' . $student->section->name }}">{{ $student->section->name }}</td>
                            <td title="{{ $student->email }}">{{ Str::limit($student->email, 30) }}</td>
                            <td class="text-center">
                                <a href="{{ route('teacher.students.show', $student->id_number) }}"
                                   class="btn btn-primary btn-sm btn-block btn-hover-effect"><i
                                        class="fas fa-eye mr-1"></i> View</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    @else
        <div class="row">
            <div class="col col-md-8 offset-md-2">
                <div class="text-center pt-5 pb-5 shadow-sm mb-5 bg-white rounded empty-data-section shadow">
                    <h2 class="text-center text-warning display-4">Empty.</h2>
                    <a href="{{ route('teacher.students.create') }}" class="btn btn-lg mt-4 bg-gradient-primary"><i
                            class="fas fa-pen-alt mr-1"></i> Add Students</a>
                </div><!-- /.empty-data-section -->
            </div><!-- /.col col-md-8 offset-md-2 -->
        </div><!-- /.row -->
    @endif
@endsection

@section('data-table-css')
    @include('partials.data-table-css')
@stop
@section('data-table-js')
    @include('partials.data-table-js')
@stop

