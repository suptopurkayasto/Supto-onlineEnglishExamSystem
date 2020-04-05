@extends('layouts.teacher')

@section('title', 'Show Synonym Word Options')


@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="h3 card-title">Show Synonym Word Options</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form action="" method="post">
                @csrf

                <div class="form-group row">
                    <div class="col-12 col-md-4">
                        <label for="option">Option</label>
                    </div><!-- /.col-12 col-md-4 -->
                    <div class="col-12 col-md-8">
                        <input type="text" name="option" id="option"
                               class="form-control @error('option') is-invalid @enderror"
                               value="{{ $option->options }}"
                               disabled>
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
                        <a href="{{ route('teachers.questions.synonyms.options.edit', $option->id) }}?exam={{ request()->get('exam') }}&set={{ request()->get('set') }}"
                           class="btn bg-gradient-primary"><i class="far fa-edit mr-1"></i> Edit
                            Synonym Word Options
                        </a>
                        @if($option->synonym()->count() < 1)
                            <form action="{{ route('teachers.questions.synonyms.options.destroy', 1) }}?exam={{ request()->get('exam') }}&set={{ request()->get('set') }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Are you sure you want to delete: {{ $option->options }}')"><i
                                        class="fas fa-trash-alt mr-1"></i> Delete Synonym Word Options
                                </button>
                            </form>
                        @endif
                    </div><!-- /.col-12 col-md-8 -->
                </div><!-- /.form-group -->

            </form>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
@endsection
