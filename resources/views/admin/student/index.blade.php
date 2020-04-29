@extends('layouts.admin')

@section('title', 'All Students')

@section('content')
    @if($students->count() > 0)
        <div class="card index-card">
            <div class="card-header">
                <h3 class="card-title index-card-title">All Students</h3>
            </div>
            <!-- /.card-header -->
            <div class="progress">
                <div class="progress-bar bg-primary" role="progressbar" style="width: 100%" aria-valuenow="100"
                     aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <div class="card-body">
                <table id="" class="example table table-striped table-bordered dt-responsive nowrap border-0 table-hover custom-table-style" style="width: 100%">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Location</th>
                        <th>Creator</th>
                        <th class="text-center">Group</th>
                        <th class="text-center">Section</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($students as $index => $student)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td title="{{ $student->name }}">{{ Str::limit($student->name, 20) }}</td>
                            <td title="{{ $student->email }}">{{ Str::limit($student->email, 30) }}</td>
                            <td title="{{ $student->location->name }}">{{ Str::limit($student->location->name, 40) }}</td>
                            <td title="{{ $student->teacher->name }}">{{ Str::limit($student->teacher->name, 40) }}</td>
                            <td class="text-center" title="{{ 'Group: ' . $student->group->name }}">{{ $student->group->name }}</td>
                            <td class="text-center" title="{{ 'Section: ' . $student->section->name }}">{{ $student->section->name }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.students.show', $student->id) }}"
                                   class="btn btn-primary btn-sm btn-block btn-hover-effect">View</a>
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
                    <a href="{{ route('admin.students.create') }}" class="btn btn-lg mt-4 bg-gradient-primary">Add Student</a>
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
