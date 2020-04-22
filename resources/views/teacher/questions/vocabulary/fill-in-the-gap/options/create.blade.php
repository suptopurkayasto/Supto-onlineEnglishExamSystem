@extends('layouts.teacher')

@section('title', 'Add Fill In The Gap Options')


@section('content')
    <div class="row justify-content-center">
        <div class="col-12 col-md-8">
            <div class="card shadow">
                <div class="card-header">
                    <h3 class="h3 card-title">Add Fill In The Gap Options</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form action="{{ route('teachers.questions.fill-in-the-gaps.options.store') }}?exam={{ request()->get('exam') }}&set={{ request()->get('set') }}" method="post">
                        @csrf

                        <div class="form-group row">
                            <div class="col-12 col-md-2">
                                <label for="option">Option</label>
                            </div><!-- /.col-12 col-md-2 -->
                            <div class="col-12 col-md-10">
                                <input type="text" name="option" id="option"
                                       class="form-control @error('option') is-invalid @enderror"
                                       value="{{ old('option') }}"
                                       required autofocus>
                                @error('option')
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
                                    <div class="col-6">
                                        <button type="submit" class="btn bg-gradient-primary btn-block"><i class="fas fa-check"></i> Add
                                            Fill In The Gap Option
                                        </button>
                                    </div><!-- /.col-6 -->
                                </div><!-- /.row -->
                            </div><!-- /.col-12 col-md-10 -->
                        </div><!-- /.form-group -->

                    </form>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection
