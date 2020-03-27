@extends('layouts.teacher')

@section('title', 'All Students Exams Result')

@section('content')
    @if($exams->count() > 0)
        @foreach($exams as $exam)
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $exam->name }} Result</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example"
                           class="table table-striped table-bordered dt-responsive nowrap border-0 table-hover custom-table-style"
                           style="width: 100%">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Group</th>
                            <th>Section</th>
                            <th>Grammar</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($students as $index => $student)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td title="{{ $student->name }}">{{ Str::limit($student->name, 20) }}</td>
                                <td title="{{ 'Group: ' . $student->group->name }}">{{ $student->group->name }}</td>
                                <td title="{{ 'Section: ' . $student->section->name }}">{{ $student->section->name }}</td>
                                <td>{{ $student->grammarMarks['got_marks'] }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        @endforeach
    @else
        <div class="empty-data-section">
            <h2 class="text-center text-warning mt-5 display-1 font-weight">Empty.</h2>
            <a href="{{ route('teacher.students.create') }}" class="btn btn-lg mt-4 bg-gradient-primary">Add Student</a>
        </div><!-- /.empty-data-section -->
    @endif
@endsection

@section('data-table-css')
    @include('partials.data-table-css')
@stop
@section('data-table-js')
    @include('partials.data-table-js')
@stop

