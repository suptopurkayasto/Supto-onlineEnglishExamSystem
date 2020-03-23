@extends('layouts.admin')

@section('title', 'Show All Teachers')

@section('content')
    @if($teachers->count() > 0)
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">All Teachers</h3>
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
                        <th>Email</th>
                        <th>Location</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($teachers as $index => $teacher)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $teacher->name }}</td>
                            <td>{{ $teacher->email }}</td>
                            <td>{{ $teacher->location->name }}</td>
                            <td>
                                <a href="{{ route('admin.teachers.show', $teacher->id) }}"
                                   class="btn btn-primary btn-block btn-hover-effect">View</a>
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
            <a href="{{ route('admin.teachers.create') }}" class="btn btn-lg mt-4 bg-gradient-primary">Add Teacher</a>
        </div><!-- /.empty-data-section -->
    @endif
@endsection

@section('data-table-css')
    @include('partials.data-table-css')
@stop

@section('data-table-js')
    @include('partials.data-table-js')
@stop
