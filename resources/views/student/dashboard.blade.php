@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    @include('partials.student.navigation')

    <div class="student-main-section" style="margin-top: 100px">
        <div class="container">
            <div class="shadow rounded p-3 border border-primary">
                <div class="form-row">
                    <div class="col-12 col-lg-4 mb-5 mb-lg-0">
                        <img title="{{ $authStudent->name }}" class="border-primary border rounded"
                             style="width: 100%; border-width: 2px !important;"
                             src="{{ Gravatar::get(auth()->guard('student')->user()->email) }}" alt="">
                    </div><!-- /.col-12 col-md-5 mb-5 mb-md-0 -->
                    <div class="col-12 col-lg-8">
                        <h2
                            title="{{ auth()->guard('student')->user()->name }}"
                            class="h2">{{ Str::limit(auth()->guard('student')->user()->name, 30) }}</h2>
                        <span class="d-block w-100 bg-primary" style="height: 2px; clear: both"></span>


                        <table class="table table-hover table-bordered rounded">
                            <h5 class="custom-table-heading h4 border border text-center my-0 py-2 mt-2 font-weight-bolder table-heading-bg">
                                Exam Marks
                                Table</h5>
                            <thead>
                            <tr>
                                <th>Exam Name</th>
                                <th>Grammar</th>
                                <th>Vocabulary</th>
                                <th>Reading</th>
                                <th>Writing</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($exams as $exam)
                                <tr class="text-center">
                                    <td class="text-left">{{ $exam->name }}</td>
                                    <td>
                                        @php $grammarStudentMarks = $authStudent->grammarMarks()->where('id', 1)->get()->first() @endphp

                                        @if($grammarStudentMarks != null)
                                            {{ $grammarStudentMarks->got_marks }}
                                        @else
                                            0
                                        @endif
                                    </td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td class="font-weight-bolder">{{ __( '0' ) }}</td>
                                    <td>
                                        @if($exam->status == 'running')
                                            <a href="{{ route('student.exam.subject', $exam->slug) }}" class="btn btn-primary btn-sm">Start Quiz</a>
                                        @elseif($exam->status == 'complete')
                                            <span class="text-success"><i class="fas fa-check"></i> Completed</span>
                                        @elseif($exam->status == 'cancel')
                                            <span class="text-danger"><i class="fas fa-times"></i> Canceled</span>
                                        @elseif($exam->status == 'pending')
                                            Pending
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div><!-- /.col-12 col-md-7 -->
                </div><!-- /.row -->
            </div><!-- /.shadow rounded p-4 -->
        </div><!-- /.container -->
    </div><!-- /.student-main-section -->

@endsection
