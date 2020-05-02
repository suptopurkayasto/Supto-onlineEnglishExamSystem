@extends('layouts.app')

@section('title', 'Dashboard - ' . $authStudent->name)

@section('content')

    <div class="student-main-section h-100">
        <div class="container-fluid h-100">
            <div class="h-100 w-100 flex-wrap d-flex justify-content-center align-items-center">
                <div class="student-info-sec shadow rounded p-3 border w-100 bg-white">
                    <div class="form-row justify-content-center">
                        <div class="col-12 col-sm-8 col-lg-4 mb-5 mb-lg-0">
                            @if(Gravatar::exists($authStudent->email))
                                <div class="bg-primary rounded w-100 h-100">
                                    <img title="{{ $authStudent->name }}" class="img-thumbnail"
                                         style="width: 100%; border-width: 2px !important;"
                                         src="{{ Gravatar::get($authStudent->email, ['size' => 1024]) }}"
                                         alt="">
                                </div><!-- /. -->
                            @else
                                <a target="_blank" href="https://wordpress.com/start/wpcc/oauth2-user?ref=oauth2&oauth2_redirect=https%3A%2F%2Fpublic-api.wordpress.com%2Foauth2%2Fauthorize%2F%3Fclient_id%3D1854%26response_type%3Dcode%26blog_id%3D0%26state%3D84fbe028b6d17dae37160d77ebf23df57686f8b42305c8151326ccf90f872a19%26redirect_uri%3Dhttps%253A%252F%252Fen.gravatar.com%252Fconnect%252F%253Faction%253Drequest_access_token%26jetpack-code%26jetpack-user-id%3D0%26action%3Doauth2-login&oauth2_client_id=1854" title="Create Gravatar account for set your profile photo">
                                    <img src="https://www.gravatar.com/avatar/42875a70a57aed53585c58e7b60ed26e.jpg?s=400&d=mm&r=g" class="img-thumbnail" alt="">
                                </a>
                            @endif
                        </div><!-- /.col-12 col-md-5 mb-5 mb-md-0 -->
                        <div class="col-12 col-sm-8 col-lg-8">
                            <div class="top-section px-2 d-flex justify-content-between align-items-center p-1">
                                <h2 title="{{ $authStudent->name }}"
                                    class="h2 font-weight-bolder">
                                    {{ Str::limit($authStudent->name, 30) }}
                                    @if(session('welcome'))
                                        <span class="badge badge-primary font-weight-normal mr-1">
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
                                <div class="btn-group">
                                    <button type="button" class="btn btn-outline-danger btn-sm dropdown-toggle"
                                            data-toggle="dropdown" data-display="static" aria-haspopup="true"
                                            aria-expanded="false">
                                        <i class="fad fa-sign-out mr-1"></i> Log Out
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-lg-right">
                                        <form action="{{ route('student.logout') }}" method="post" class=""
                                              id="studentLogOutForm">
                                            @csrf
                                            <button type="submit" class="dropdown-item">Logout</button>
                                        </form>
                                    </div>
                                </div>
                            </div><!-- /.shadow -->

                            <div class="student-count-marks-table-wrap">
                                <table class="table table-hover table-borderless rounded">
                                    <h5 class="custom-table-heading h4 text-center my-0 py-2 mt-2 font-weight-bolder">Marks</h5>
                                    <thead>
                                    <tr class="text-center">
                                        <th class="text-left">Exam Name</th>
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
                                        @if($exam->status == 'running' || $exam->status == 'complete')
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

                                            // Writing
                                            $dialog = $exam->marks()->where('student_id', $authStudent->id)->first()->dialog;
                                            $informalEmail = $exam->marks()->where('student_id', $authStudent->id)->first()->informalEmail;
                                            $formalEmail = $exam->marks()->where('student_id', $authStudent->id)->first()->formalEmail;
                                            $sortQuestion = $exam->marks()->where('student_id', $authStudent->id)->first()->sortQuestion;

                                            $writingTotal = $dialog + $informalEmail + $formalEmail + $sortQuestion;

                                            ?>
                                            <tr class="text-center">
                                                <td class="text-left"
                                                    title="{{ $exam->name }}">{{ Str::limit($exam->name, 20) }}</td>

                                                <td title="{{ 'Grammar: '.$grammar }}">{{ $grammar === null ? 0 : $grammar }}</td>

                                                <td title="{{ 'Synonym: '.$synonym.', Definition: '.$definition.', Combination: '.$combination.', Fill in the gap: '.$fillInTheGap }}">{{ $vocabularyTotal }}</td>

                                                <td title="{{ 'Heading Matching: '.$heading.', Rearrange: '.$rearrange }}">{{ $readingTotal }}</td>

                                                <td title="{{ 'Dialog: '.$dialog.', Informal Email: '.$informalEmail.', Formal Email: '.$formalEmail.', Sort Question: '.$sortQuestion }}">{{ $writingTotal }}</td>
                                                <td class="font-weight-bolder">{{ $grammarTotal + $vocabularyTotal + $readingTotal + $writingTotal }}</td>
                                                <td>
                                                    @if($exam->status == 'running')
                                                        <a
                                                            href="{{ route('student.exam.show.topic', encrypt($exam->id)) }}"
                                                            class="btn btn-primary btn-block btn-sm {{ $grammar !== null && $synonym !== null && $definition !== null && $combination !== null && $fillInTheGap !== null && $heading !== null && $rearrange !== null ? 'disabled' : '' }}">
                                                            <i class="fad fa-running mr-1"></i> Start Quiz</a>
                                                    @elseif($exam->status == 'complete')
                                                        <a href="{{ route('student.exam.answer-sheets.show', [encrypt($exam->id), encrypt($authStudent->id)]) }}" class="btn btn-sm btn-success btn-block"><i class="fad fa-eye"></i></a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                            </div><!-- /.student-count-marks-table-wrap -->

                        </div><!-- /.col-12 col-md-7 -->
                    </div><!-- /.row -->
                </div><!-- /.shadow rounded p-4 -->
            </div><!-- /.h-100 d-flex justify-content-center align-items-center -->
        </div><!-- /.container -->
    </div><!-- /.student-main-section -->

@endsection

@section('extra-script')
    <script>
        var height = $(window).innerHeight();
        $('body').css({'height': height});
    </script>
@endsection
