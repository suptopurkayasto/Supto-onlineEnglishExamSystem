@extends('layouts.teacher')

@section('title', 'All Synonym Questions')

@section('content')
    @if($authTeacher->exams()->count() > 0)
        @foreach($authTeacher->exams as $exam)
            @if($exam->synonyms()->count() > 0)
                <div class="card mb-5">
                    <div
                        class="card-header">
                        <h3 class="card-title float-left" title="{{ $exam->name }}"><span
                                class="font-weight-bolder">{{ Str::limit($exam->name, 30) }}</span>
                            Synonym Word
                        </h3>
                        @if($exam->synonyms()->count() !== 20)
                            <a href="{{ route('teachers.questions.synonyms.create') }}?exam={{ encrypt($exam->id) }}"
                               class="btn bg-gradient-primary float-right btn-hover-effect">
                                <i class="fas fa-pen-alt mr-1"></i>
                                Add Synonym Word</a>
                        @endif
                    </div><!-- /.card-header -->
                    @if($exam->synonyms()->count() === 20 && $exam->synonymOptions()->count() === 40)
                        <div class="progress" style="height: 7px">
                            <div class="progress-bar progress-bar-striped bg-primary progress-bar-animated" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    @else
                        <div class="progress" style="height: 7px">
                            <div class="progress-bar progress-bar-striped bg-danger progress-bar-animated" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    @endif
                    <div class="card-body">
                        <div class="row">
                            @foreach($exam->sets as $set)
                                @php $synonymCountBySet = $exam->synonyms()->where('question_set_id', $set->id)->get()->count() @endphp
                                <div class="col-12 col-md-6 col-lg-3 count-section">
                                    <div class="info-box bg-white border-primary border">
                                    <span class="info-box-icon text-primary"
                                          style="font-weight: 900">{{ $set->name }}</span>
                                        <div class="info-box-content">
                                            <span class="info-box-number font-weight-normal">{{ $synonymCountBySet }} / 5 Synonym word.</span>

                                            <div class="progress">
                                                <div class="progress-bar"
                                                     style="width: {{ ($synonymCountBySet*100)/5 }}%"></div>
                                            </div>
                                            <div class="progress-description">
                                                @if($synonymCountBySet === 5)
                                                    @if($exam->synonymOptions()->where('question_set_id', $set->id)->get()->count() === 10)
                                                        <a href="{{ route('teachers.questions.synonyms.options.index') }}?exam={{ encrypt($exam->id) }}&set={{ encrypt($set->id) }}"
                                                           class="btn btn-sm btn-primary btn-block">View
                                                            Option</a>
                                                    @else
                                                        <a href="{{ route('teachers.questions.synonyms.options.create') }}?exam={{ encrypt($exam->id) }}&set={{ encrypt($set->id) }}"
                                                           class="btn btn-sm btn-outline-primary btn-block">Add
                                                            Options</a>
                                                    @endif
                                                @else
                                                    <a href="{{ route('teachers.questions.synonyms.create') }}?exam={{ encrypt($exam->id) }}&set={{ encrypt($set->id) }}"
                                                       class="btn btn-sm btn-outline-primary btn-block">Add Words</a>
                                                @endif
                                            </div>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                </div><!-- /.col -->
                            @endforeach

                            <div class="col-12">
                                <table
                                    id="example"
                                    class="table table-striped table-bordered dt-responsive nowrap border-0 table-hover custom-table-style"
                                    style="width: 100%">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Word</th>
                                        <th>Set</th>
                                        <th>Exam</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($exam->synonyms as $index => $synonym)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td title="{{ $synonym->word }}">{{ Str::limit($synonym->word, 70) }}</td>
                                            <td>{{ $synonym->set->name }}</td>
                                            <td>{{ $synonym->exam->name }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('teachers.questions.synonyms.show', $synonym->id) }}?exam={{ encrypt($synonym->exam->id) }}&set={{ encrypt($synonym->set->id) }}"
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
                <div class="text-center pt-5 pb-5 shadow-sm mb-5 bg-white rounded">
                    <h1 class="h1" title="{{ $exam->name }}">{{ Str::limit($exam->name, 30) }}</h1>
                    <h2 class="text-center text-warning display-4">Empty.</h2>
                    <a href="{{ route('teachers.questions.synonyms.create') }}?exam={{ encrypt($exam->id) }}"
                       class="btn btn-lg mt-4 bg-gradient-primary"><i
                            class="fas fa-pen-alt"></i> Add Synonym Word</a>
                </div><!-- /.empty-data-section -->
            @endif
        @endforeach
    @else
        <div class="empty-data-section add-exam-mini-section">
            <h1 class="h1">You need to add Exam first.</h1>
            <a href="{{ route('teacher.exams.create') }}" class="btn btn-lg mt-4 bg-gradient-primary"><i
                    class="fas fa-pen-alt"></i> Add Exam</a>
        </div><!-- /.empty-data-section -->
    @endif
@endsection

@section('data-table-css')
    @include('partials.data-table-css')
@stop
@section('data-table-js')
    @include('partials.data-table-js')
@stop

