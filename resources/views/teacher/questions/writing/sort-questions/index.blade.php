@extends('layouts.teacher')

@section('title', 'All Sort Questions')

@section('content')
    @if($authTeacher->exams()->count() > 0)
        @foreach($authTeacher->exams as $exam)
            @if($exam->sortQuestions()->count() > 0)
                <div class="card mb-5 index-card">
                    <div class="card-header">
                        <h3 class="card-title index-card-title float-left {{ $exam->sortQuestions()->count() === 28 ? 'text-success' : 'text-warning' }}" title="{{ $exam->name }}">
                            <span>{{ Str::limit($exam->name, 30) }}</span>
                            <span class="font-weight-bolder ml-2">Sort Questions</span>
                            @if($exam->sortQuestions()->count() === 28)
                                <i class="fas fa-check-circle"></i>
                            @endif

                        </h3>
                        @if($exam->sortQuestions()->count() !== 28)
                            <a href="{{ route('teachers.questions.sort-questions.create') }}?exam={{ encrypt($exam->id) }}"
                               class="btn btn-primary float-right btn-hover-effect"><i class="fas fa-pen-alt mr-1"></i> Add
                                Sort Question</a>
                        @endif
                    </div><!-- /.card-header -->
                    @if($exam->sortQuestions()->count() === 28)
                        <div class="progress" style="height: 7px">
                            <div class="progress-bar bg-success"
                                 role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0"
                                 aria-valuemax="100"></div>
                        </div>
                    @else
                        <div class="progress" style="height: 7px">
                            <div class="progress-bar bg-warning"
                                 role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0"
                                 aria-valuemax="100"></div>
                        </div>
                    @endif
                    <div class="card-body">
                        <div class="row">
                            @foreach($exam->sets as $set)
                                @php $sortQuestionCountBySet = $exam->sortQuestions()->where('set_id', $set->id)->get()->count() @endphp
                                <div class="col-12 col-md-6 col-lg-3 count-section">
                                    <div class="info-box bg-white border {{ $sortQuestionCountBySet === 7 ? ' border-success': ' border-warning' }}">
                                    <span class="info-box-icon text-white {{ $sortQuestionCountBySet === 7 ? 'bg-success': 'bg-warning' }}"
                                          style="font-weight: 900">{{ $set->name }}</span>
                                        <div class="info-box-content">
                                            <span class="info-box-number font-weight-normal">{{ $sortQuestionCountBySet }} / 7 Sort questions.</span>

                                            <div class="progress">
                                                <div class="progress-bar {{ $sortQuestionCountBySet === 7 ? 'bg-success': 'bg-warning' }}"
                                                     style="width: {{ ($sortQuestionCountBySet*100)/7 }}%"></div>
                                            </div>
                                            <span class="progress-description">
                                                @if($sortQuestionCountBySet < 7)
                                                    <a href="{{ route('teachers.questions.sort-questions.create') }}?exam={{ encrypt($exam->id) }}&set={{ encrypt($set->id)}}"
                                                       class="btn-link"><i class="fas fa-pen-square"></i> Add sort question</a>
                                                @else
                                                    <span class="text-success"><i class="fas fa-check-circle"></i> Done</span>
                                                @endif
                                            </span>
                                        </div><!-- /.info-box-content -->
                                    </div>
                                </div><!-- /.col -->
                            @endforeach

                            <div class="col-12">
                                    <table
                                        id=""
                                        class="example table table-striped table-bordered dt-responsive nowrap border-0 table-hover custom-table-style"
                                        style="width: 100%">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Topic</th>
                                            <th>Set</th>
                                            <th>Exam</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($exam->sortQuestions()->orderByDesc('id')->get() as $index => $sortQuestion)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td title="{{ $sortQuestion->question }}">{{ Str::limit($sortQuestion->question, 90) }}</td>
                                                <td>{{ $sortQuestion->set->name }}</td>
                                                <td title="{{ $sortQuestion->exam->name }}">{{ Str::limit($sortQuestion->exam->name, 40) }}</td>
                                                <td class="text-center">
                                                    <a href="{{ route('teachers.questions.sort-questions.show', $sortQuestion->id) }}?exam={{ encrypt($sortQuestion->exam->id) }}"
                                                       class="btn btn-primary btn-sm btn-block btn-hover-effect"><i
                                                            class="fas fa-eye mr-1"></i> View</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                            </div><!-- /.col-12 -->
                        </div><!-- /.row -->
                    </div><!-- /.card-body -->
                </div><!-- /.card -->
            @else

                <div class="row">
                    <div class="col col-md-8 offset-md-2">
                        <div class="text-center pt-5 pb-5 shadow-sm mb-5 bg-white rounded empty-data-section shadow">
                            <h1 class="h1" title="{{ $exam->name }}">{{ Str::limit($exam->name, 30) }}</h1>
                            <h2 class="text-center text-warning display-4">Empty.</h2>
                            <a href="{{ route('teachers.questions.sort-questions.create') }}?exam={{ encrypt($exam->id) }}"
                               class="btn btn-lg mt-4 bg-gradient-primary"><i
                                    class="fas fa-pen-alt"></i> Add Sort Question</a>
                        </div><!-- /.empty-data-section -->
                    </div><!-- /.col col-md-8 offset-md-2 -->
                </div><!-- /.row -->

            @endif
        @endforeach
    @else

        <div class="row">
            <div class="col col-md-8 offset-md-2">
                <div class="empty-data-section add-exam-mini-section">
                    <h1 class="h1">You need to add Exam first.</h1>
                    <a href="{{ route('teacher.exams.create') }}" class="btn btn-lg mt-4 bg-gradient-primary"><i
                            class="fas fa-pen-alt"></i> Add Exam</a>
                </div><!-- /.empty-data-section -->
            </div><!-- /.col col-md-8 offset-md-2 -->
        </div><!-- /.row -->


    @endif
@endsection

@section('data-table-css')
    @include('partials.data-table-css')
@stop
@section('data-table-js')
    @include('partials.data-table-js')
@stop

