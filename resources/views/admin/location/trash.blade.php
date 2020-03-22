@extends('layouts.admin')

@section('title', 'All Trash Locations')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Show All Trash Locations</h3>
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
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($locations as $index => $location)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td title="{{ $location->name }}"> Sheikh Kamal IT Training and Incubation Center
                            in <strong>{{ $location->name }}</strong></td>
                        <td class="text-center">
                            <form action="{{ route('admin.location.trash.restore', $location->slug) }}" method="post"
                                  class="d-inline">
                                @method('PATCH')
                                @csrf
                                <button type="submit" class="btn bg-gradient-warning"
                                        onclick="return confirm('Are you sure restore {{ $location->name }}!')">
                                    Restore
                                </button>
                            </form>
                            <form action="{{ route('admin.location.trash.delete', $location->slug)}}" method="post"
                                  class="d-inline">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn bg-gradient-danger"
                                        onclick="return confirm('Are you sure delete {{ $location->name }} location')">
                                    Delele
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
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
