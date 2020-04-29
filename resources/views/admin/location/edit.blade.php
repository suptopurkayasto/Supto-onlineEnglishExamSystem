@extends('layouts.admin')

@section('title', 'Edit location - ' . $location->name)

@section('content')

    <div class="row justify-content-center">
        <div class="col-12 col-sm-8 col-md-6">
            <div class="card shadow">
                <div class="card-header">
                    <h3 class="card-title">Edit location</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form action="{{ route('admin.locations.update', $location->slug) }}" method="post">
                        @method('PATCH')
                        @csrf
                        <div class="form-group row">
                            <div class="col-12 col-md-2">
                                <label for="name">Name</label>
                            </div><!-- /.col-12 col-md-2 -->
                            <div class="col-12 col-md-10">
                                <input type="text" name="name" id="name"
                                       class="form-control @error('name') is-invalid @enderror" value="{{ $location->name }}"
                                >
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
                                        <button type="submit" class="btn bg-gradient-primary btn-block"><i class="fas fa-check-circle mr-1"></i> Update Location</button>
                                    </div><!-- /.col col-md-6 -->
                                </div><!-- /.row -->
                            </div><!-- /.col-12 col-md-10 -->
                        </div><!-- /.form-group -->
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div><!-- /.col-12 col-sm-8 col-md-6 -->
    </div><!-- /.row justify-content-center -->
@endsection
