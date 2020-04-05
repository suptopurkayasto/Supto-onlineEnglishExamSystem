@extends('layouts.teacher')

@section('title', 'Edit Combination Options')


@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="h3 card-title">Edit Combination Options</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form action="{{ route('teachers.questions.combinations.options.update', $option->id) }}?exam={{ request()->get('exam') }}&set={{ request()->get('set') }}" method="post">
                @csrf
                @method('PUT')
                <div class="form-group row">
                    <div class="col-12 col-md-4">
                        <label for="option">Option</label>
                    </div><!-- /.col-12 col-md-4 -->
                    <div class="col-12 col-md-8">
                        <input type="text" name="option" id="option"
                               class="form-control @error('option') is-invalid @enderror"
                               value="{{ $option->options }}"
                               required>
                        @error('option')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div><!-- /.col-12 col-md-8 -->
                </div><!-- /.form-group -->

                <div class="form-group row">
                    <div class="col-12 col-md-4">
                    </div><!-- /.col-12 col-md-4 -->
                    <div class="col-12 col-md-8">
                        <button type="submit" class="btn bg-gradient-primary"><i class="fas fa-check mr-1"></i> Update
                            Combination Options
                        </button>
                    </div><!-- /.col-12 col-md-8 -->
                </div><!-- /.form-group -->

            </form>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
@endsection
