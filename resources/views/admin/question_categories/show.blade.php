@extends('layouts.admin')

@section('title', 'Show question category - ' . $questionCategory->name)

@section('content')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Show question category</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="form-group row">
                <div class="col-12 col-md-4">
                    <label for="name">Question category name</label>
                </div><!-- /.col-12 col-md-4 -->
                <div class="col-12 col-md-8">
                    <input type="text" name="name" id="name"
                           class="form-control @error('name') is-invalid @enderror" value="{{ $questionCategory->name }}"
                           readonly>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div><!-- /.col-12 col-md-8 -->
            </div><!-- /.form-group -->

            <div class="form-group row">
                <div class="col-12 col-md-4">
                </div><!-- /.col-12 col-md-4 -->
                <div class="col-12 col-md-8 d-flex">
                    <a href="{{ route('admin.question-categories.edit', $questionCategory->slug) }}" class="btn bg-gradient-warning">Edit Question Category</a>
                    <form action="{{ route('admin.question-categories.destroy', $questionCategory->slug) }}" method="post"
                          class="ml-3">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn bg-gradient-danger"
                                onclick="return confirm('Are you sure you want to delete {{ $questionCategory->name }}')">
                            Delete Question Category
                        </button>
                    </form>
                </div><!-- /.col-12 col-md-8 -->
            </div><!-- /.form-group -->
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
@endsection
