@extends('layouts.admin')

@section('title', 'All Teachers')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Show All Teachers</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example"
                   class="table table-striped table-bordered dt-responsive nowrap border-0 table-hover custom-table-style"
                   style="width: 100%">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($teachers as $teacher)
                    <tr>
                        <td>{{ $teacher->name }}</td>
                        <td>{{ $teacher->email }}</td>
                        <td>
                            <a href="{{ route('admin.teachers.show', $teacher->id) }}"
                               class="btn btn-primary btn-block btn-hover-effect">View</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
@endsection

@section('data-table-css')
    @include('partials.data-table-css')
@stop

@section('data-table-js')
    @include('partials.data-table-js')
@stop
