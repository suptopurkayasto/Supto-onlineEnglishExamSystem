@extends('layouts.app')

@section('title', 'Chose Exam Subject')

@section('content')
    @include('partials.student.navigation')

    <div class="container">
        <div class="middle-section" style="margin-top: 100px">
            <form action="{{ route('student.show.quiz', $exam->slug) }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-12 col-md-4 offset-md-4">
                        <div class="form-group mx-auto">
                            <h4 class="h4 mb-1 text-center">Select Exam Subject</h4>
                            <span class="d-block w-100 bg-primary mb-4" style="height: 2px"></span>
                            <select name="exam_subject" id="exam_subject" class="form-control @error('exam_subject') is-invalid @enderror">
                                <option selected disabled>Select Category</option>
                                <option value="grammar">Grammar</option>
                            </select>
                            @error('exam_subject')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div><!-- /.form-group -->
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary w-50 btn-hover-effect">Start Quiz</button>
                        </div><!-- /.form-group -->
                    </div><!-- /.col-12 col-md-4 offset-md-4 -->
                </div><!-- /.row -->
            </form>
        </div><!-- /.middle-section -->
    </div><!-- /.container -->

@endsection
