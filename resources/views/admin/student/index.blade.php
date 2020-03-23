@extends('layouts.admin')

@section('title', 'All Students')

@section('content')
    @if($students->count() > 0)
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">All Students</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example" class="table table-striped table-bordered dt-responsive nowrap border-0 table-hover custom-table-style" style="width: 100%">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>ID Number</th>
                        <th>Name</th>
                        <th>Group</th>
                        <th>Section</th>
                        <th>Email</th>
                        <th>Location</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($students as $index => $student)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td title="{{ 'ID Number: ' . $student->id_number }}">{{ $student->id_number }}</td>
                            <td title="{{ $student->name }}">{{ Str::limit($student->name, 20) }}</td>
                            <td title="{{ 'Group: ' . $student->group->name }}">{{ $student->group->name }}</td>
                            <td title="{{ 'Section: ' . $student->section->name }}">{{ $student->section->name }}</td>
                            <td title="{{ $student->email }}">{{ Str::limit($student->email, 30) }}</td>
                            <td title="{{ $student->location->name }}">{{ Str::limit($student->location->name, 40) }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.students.show', $student->id_number) }}"
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
        <div class="empty-data-section">
            <h2 class="text-center text-warning mt-5 display-1 font-weight">Empty.</h2>
        </div><!-- /.empty-data-section -->
    @endif
@endsection

@section('data-table-css')
    @include('partials.data-table-css')
@stop
@section('data-table-js')
    @include('partials.data-table-js')
@stop
