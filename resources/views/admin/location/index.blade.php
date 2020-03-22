@extends('layouts.admin')

@section('title', 'All Locations')

@section('content')
    @if($locations->count() > 0)
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Show All Locations</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example"
                       class="table table-striped table-bordered dt-responsive nowrap border-0 table-hover custom-table-style"
                       style="width: 100%">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th style="text-align: left">Name</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($locations as $index => $location)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td style="text-align: left" title="{{ $location->name }}">{{ $location->name }}</td>
                            <td>
                                <a href="{{ route('admin.locations.show', $location->slug) }}"
                                   class="btn btn-primary btn-hover-effect">View</a>
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
