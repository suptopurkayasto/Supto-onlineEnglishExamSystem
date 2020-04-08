@extends('layouts.teacher')

@section('title', 'Edit Rearrange')


@section('content')
    <div class="row justify-content-center">
        <div class="col-12 col-md-8">
            <div class="card shadow">
                <div class="card-header">
                    <h3 class="h3 card-title">Edit Rearrange</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form action="{{ route('teachers.questions.rearranges.update', $rearrange->id) }}?exam={{ request()->get('exam') }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <div class="col-12 col-md-2">
                                <label for="exam">Exam</label>
                            </div><!-- /.col-12 col-md-2 -->
                            <div class="col-12 col-md-10">
                                <select name="exam" id="exam" class="form-control @error('exam') is-invalid @enderror" required>
                                    <option required selected>Select exam</option>
                                    @foreach($authTeacher->exams as $exam)
                                        <option
                                            {{ $rearrange->exam->id == $exam->id ? 'selected' : '' }} value="{{ $exam->id }}">{{ $exam->name }}</option>
                                    @endforeach
                                </select>
                                @error('exam')
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                                @enderror
                            </div><!-- /.col-12 col-md-10 -->
                        </div><!-- /.form-group row -->

                        <div class="form-group row">
                            <div class="col-12 col-md-2">
                                <label for="questionSet">Question Set</label>
                            </div><!-- /.col-12 col-md-2 -->
                            <div class="col-12 col-md-10">
                                <select name="questionSet" id="questionSet"
                                        class="form-control @error('questionSet') is-invalid @enderror" required>
                                    <option selected>Select group</option>
                                    @foreach($questionSets as $questionSet)
                                        <option
                                            {{ $rearrange->set->id == $questionSet->id ? 'selected' : '' }} value="{{ $questionSet->id }}">{{ $questionSet->name }}</option>
                                    @endforeach
                                </select>
                                @error('questionSet')
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                                @enderror
                            </div><!-- /.col-12 col-md-10 -->
                        </div><!-- /.form-group row -->


                        <div class="form-group row">
                            <div class="col-12 col-md-2">
                                <label for="line_1">Line One</label>
                            </div><!-- /.col-12 col-md-2 -->
                            <div class="col-12 col-md-10">
                                <input type="text" name="line_1" id="line_1"
                                       class="form-control @error('line_1') is-invalid @enderror"
                                       value="{{ $rearrange->line_1 }}"
                                       required>
                                @error('line_1')
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                                @enderror
                            </div><!-- /.col-12 col-md-10 -->
                        </div><!-- /.form-group row -->

                        <div class="form-group row">
                            <div class="col-12 col-md-2">
                                <label for="line_2">Line Two</label>
                            </div><!-- /.col-12 col-md-2 -->
                            <div class="col-12 col-md-10">
                                <input type="text" name="line_2" id="line_2"
                                       class="form-control @error('line_2') is-invalid @enderror"
                                       value="{{ $rearrange->line_2 }}"
                                       required>
                                @error('line_2')
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                                @enderror
                            </div><!-- /.col-12 col-md-10 -->
                        </div><!-- /.form-group row -->

                        <div class="form-group row">
                            <div class="col-12 col-md-2">
                                <label for="line_3">Line Three</label>
                            </div><!-- /.col-12 col-md-2 -->
                            <div class="col-12 col-md-10">
                                <input type="text" name="line_3" id="line_3"
                                       class="form-control @error('line_3') is-invalid @enderror"
                                       value="{{ $rearrange->line_3 }}"
                                       required>
                                @error('line_3')
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                                @enderror
                            </div><!-- /.col-12 col-md-10 -->
                        </div><!-- /.form-group row -->

                        <div class="form-group row">
                            <div class="col-12 col-md-2">
                                <label for="line_4">Line Four</label>
                            </div><!-- /.col-12 col-md-2 -->
                            <div class="col-12 col-md-10">
                                <input type="text" name="line_4" id="line_4"
                                       class="form-control @error('line_4') is-invalid @enderror"
                                       value="{{ $rearrange->line_4 }}"
                                       required>
                                @error('line_4')
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                                @enderror
                            </div><!-- /.col-12 col-md-10 -->
                        </div><!-- /.form-group row -->

                        <div class="form-group row">
                            <div class="col-12 col-md-2">
                                <label for="line_5">Line Five</label>
                            </div><!-- /.col-12 col-md-2 -->
                            <div class="col-12 col-md-10">
                                <input type="text" name="line_5" id="line_5"
                                       class="form-control @error('line_5') is-invalid @enderror"
                                       value="{{ $rearrange->line_5 }}"
                                       required>
                                @error('line_5')
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                                @enderror
                            </div><!-- /.col-12 col-md-10 -->
                        </div><!-- /.form-group row -->

                        <div class="form-group row">
                            <div class="col-12 col-md-2">
                                <label for="line_6">Line Six</label>
                            </div><!-- /.col-12 col-md-2 -->
                            <div class="col-12 col-md-10">
                                <input type="text" name="line_6" id="line_6"
                                       class="form-control @error('line_6') is-invalid @enderror"
                                       value="{{ $rearrange->line_6 }}"
                                       required>
                                @error('line_6')
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                                @enderror
                            </div><!-- /.col-12 col-md-10 -->
                        </div><!-- /.form-group row -->

                        <div class="form-group row">
                            <div class="col-12 col-md-2">
                                <label for="line_7">Line Seven</label>
                            </div><!-- /.col-12 col-md-2 -->
                            <div class="col-12 col-md-10">
                                <input type="text" name="line_7" id="line_7"
                                       class="form-control @error('line_7') is-invalid @enderror"
                                       value="{{ $rearrange->line_7 }}"
                                       required>
                                @error('line_7')
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                                @enderror
                            </div><!-- /.col-12 col-md-10 -->
                        </div><!-- /.form-group row -->


                        <div class="form-group row">
                            <div class="col-12 col-md-2">
                            </div><!-- /.col-12 col-md-2 -->
                            <div class="col-12 col-md-10">
                                <div class="row">
                                    <div class="col col-md-6">
                                        <button type="submit" class="btn bg-gradient-primary btn-block"><i class="fas fa-check mr-1"></i> Update
                                            Rearrange
                                        </button>
                                    </div><!-- /.col col-md-6 -->
                                </div><!-- /.row -->
                            </div><!-- /.col-12 col-md-10 -->
                        </div><!-- /.form-group -->

                    </form>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div><!-- /.col-12 col-md-8 -->
    </div><!-- /.row -->
@endsection
