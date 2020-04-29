@extends('layouts.admin')

@section('title', 'Show location - ' . $location->name)


@section('content')
    <div class="row justify-content-center">
        <div class="col-12 col-sm-8 col-md-6">
            <div class="card shadow">
                <div class="card-header">
                    <h3 class="card-title">Show location</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                    <div class="form-group row">
                        <div class="col-12 col-md-2">
                            <label for="name">Name</label>
                        </div><!-- /.col-12 col-md-2 -->
                        <div class="col-12 col-md-10">
                            <input type="text" name="name" id="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   value="{{ $location->name }}"
                                   readonly>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div><!-- /.col-12 col-md-10 -->
                    </div><!-- /.form-group -->

                    <div class="form-group row">
                        <div class="col-12 col-md-2">
                        </div><!-- /.col-12 col-md-2 -->
                        <div class="col-12 col-md-10">
                            <div class="row">
                                <div class="col col-md-6">
                                    <a href="{{ route('admin.locations.edit', $location->slug) }}"
                                       class="btn bg-gradient-primary btn-block"><i class="fas fa-edit mr-1"></i> Edit
                                        Location</a>
                                </div><!-- /.col col-md-6 -->
                                <div class="col col-md-6">
                                    <form action="{{ route('admin.locations.destroy', $location->slug) }}" method="post"
                                          class="ml-3">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn bg-gradient-danger btn-block"
                                                onclick="return confirm('Are you sure delete location {{ $location->name }}')">
                                            <i class="fas fa-trash-alt mr-1"></i> Delete Location
                                        </button>
                                    </form>
                                </div><!-- /.col col-md-6 -->
                            </div><!-- /.row -->
                        </div><!-- /.col-12 col-md-10 -->
                    </div><!-- /.form-group -->
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div><!-- /.col-12 col-sm-8 col-md-6 -->
    </div><!-- /.row justify-content-center -->
@endsection
