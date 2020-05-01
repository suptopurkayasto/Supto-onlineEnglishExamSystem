@extends('layouts.admin')

@section('title', 'All Locations')

@section('content')
    @if($locations->count() > 0)
        <div class="card index-card">
            <div class="card-header">
                <h3 class="index-card-title float-left">Locations</h3>
                <a href="{{ route('admin.locations.create') }}" class="btn btn-lg btn-primary float-right"><i class="fas fa-map-marker-alt mr-1"></i> Add Location</a>
            </div>
            <!-- /.card-header -->
            <div class="progress">
                <div class="progress-bar bg-primary" role="progressbar" style="width: 100%" aria-valuenow="100"
                     aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <div class="card-body">
                <table id="example"
                       class="table table-striped table-bordered dt-responsive nowrap border-0 table-hover custom-table-style"
                       style="width: 100%">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th style="text-align: left">Name</th>
                        <th class="text-center">Teacher</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($locations as $index => $location)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td style="text-align: left" title="{{ $location->name }}">{{ $location->name }}</td>
                            <td class="text-center" title="Total teacher count: {{ $location->teachers()->count() }}">{{ $location->teachers()->count() }}</td>
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
        <div class="row">
            <div class="col col-md-8 offset-md-2">
                <div class="text-center pt-5 pb-5 mb-5 rounded empty-data-section">
                    <h2 class="text-center text-warning display-4">Empty.</h2>
                    <a href="{{ route('admin.locations.create') }}" class="btn btn-lg mt-4 bg-gradient-primary"><i
                            class="fas fa-pen-alt mr-1"></i> Add Location</a>
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
