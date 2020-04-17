@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    {{--    @include('partials.student.navigation')--}}

    <div class="student-main-section h-100">
        <div class="container h-100">
            <div class="h-100 w-100 flex-wrap d-flex justify-content-center align-items-center">
                <div class="student-info-sec shadow rounded p-3 border border-primary w-100">
                    <div class="form-row">
                        <div class="col-12 col-lg-4 mb-5 mb-lg-0">
                            <img title="{{ $authStudent->name }}" class="border-primary border rounded"
                                 style="width: 100%; border-width: 2px !important;"
                                 src="{{ Gravatar::get(auth()->guard('student')->user()->email, ['size' => 1024]) }}"
                                 alt="">
                        </div><!-- /.col-12 col-md-5 mb-5 mb-md-0 -->
                        <div class="col-12 col-lg-8">
                            <h2
                                id=""
                                title="{{ auth()->guard('student')->user()->name }}"
                                class="h2 float-left font-weight-bolder">
                                {{ Str::limit(auth()->guard('student')->user()->name, 30) }}
                                @if(session('welcome'))
                                    <span class="badge badge-success font-weight-normal mr-1">
                                        <i class="fas fa-smile mx-1"></i>
                                        @if (now()->format('H') < 12)
                                            Good morning
                                        @elseif (now()->format('H') < 17)
                                            Good afternoon
                                        @else
                                            Good evening
                                        @endif
                                    </span>
                                @endif
                            </h2>

                            <div class="btn-group float-right">
                                <button type="button" class="btn btn-outline-danger btn-sm dropdown-toggle"
                                        data-toggle="dropdown" data-display="static" aria-haspopup="true"
                                        aria-expanded="false">
                                    Log Out
                                </button>
                                <div class="dropdown-menu dropdown-menu-lg-right">
                                    <form action="{{ route('student.logout') }}" method="post" class=""
                                          id="studentLogOutForm">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Logout</button>
                                    </form>
                                </div>
                            </div>
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
                                    <?php
                                    $grammar = $exam->marks()->where('student_id', $authStudent->id)->first()->grammar;

                                    $grammarTotal = $grammar;


                                    // Vocabulary
                                    $synonym = $exam->marks()->where('student_id', $authStudent->id)->first()->synonym;
                                    $definition = $exam->marks()->where('student_id', $authStudent->id)->first()->definition;
                                    $combination = $exam->marks()->where('student_id', $authStudent->id)->first()->combination;
                                    $fillInTheGap = $exam->marks()->where('student_id', $authStudent->id)->first()->fillInTheGap;

                                    $vocabularyTotal = $synonym + $definition + $combination + $fillInTheGap;


                                    // Reading
                                    $heading = $exam->marks()->where('student_id', $authStudent->id)->first()->heading;
                                    $rearrange = $exam->marks()->where('student_id', $authStudent->id)->first()->rearrange;

                                    $readingTotal = $heading + $rearrange;

                                    ?>
                                    <tr class="text-center">
                                        <td class="text-left" title="{{ $exam->name }}">{{ Str::limit($exam->name, 20) }}</td>

                                        <td title="{{ 'Grammar: '.$grammar }}">{{ $grammar === null ? 0 : $grammar }}</td>

                                        <td title="{{ 'Synonym: '.$synonym.', Definition: '.$definition.', Combination: '.$combination.', Fill in the gap: '.$fillInTheGap }}">{{ $vocabularyTotal }}</td>

                                        <td title="{{ 'Heading Matching: '.$heading.', Rearrange: '.$rearrange }}">{{ $readingTotal }}</td>

                                        <td>0</td>
                                        <td class="font-weight-bolder">{{ $grammarTotal + $vocabularyTotal + $readingTotal }}</td>
                                        <td>
                                            @if($exam->status == 'running')
                                                <a
                                                    href="{{ route('student.exam.show.topic', $exam->id) }}"
                                                    class="btn btn-primary btn-sm {{ $grammar !== null && $synonym !== null && $definition !== null && $combination !== null && $fillInTheGap !== null && $heading !== null && $rearrange !== null ? 'disabled' : '' }}">Start Quiz</a>
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
            </div><!-- /.h-100 d-flex justify-content-center align-items-center -->
        </div><!-- /.container -->
    </div><!-- /.student-main-section -->

@endsection

@section('extra-script')
    <script>
        $(document).ready(function () {
            var height = $(window).innerHeight();
            $('body').css({'height': height});
        });
    </script>
@endsection
