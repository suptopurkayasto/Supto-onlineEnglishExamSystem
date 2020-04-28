@extends('layouts.teacher')

@section('title', 'All Fill In The Gap')

@section('content')
    @if($authTeacher->exams()->count() > 0)
        @foreach($authTeacher->exams()->orderByDesc('id')->get() as $exam)
            @if($exam->fillInTheGaps()->count() > 0)
                <div class="card mb-5 index-card">
                    <div
                        class="card-header">
                        <h3 class="card-title index-card-title float-left {{ $exam->fillInTheGaps()->count() === 20 && $exam->fillInTheGapOptions()->count() === 40 ? 'text-success' : 'text-warning' }}" title="{{ $exam->name }}">
                            <span>{{ Str::limit($exam->name, 30) }}</span>
                            <span class="font-weight-bolder ml-2">Fill in the gap</span>
                            @if($exam->fillInTheGaps()->count() === 20 && $exam->fillInTheGapOptions()->count() === 40)
                                <i class="fas fa-check-circle"></i>
                            @endif

                        </h3>
                        @if($exam->fillInTheGaps()->count() !== 20)
                            <a href="{{ route('teachers.questions.fill-in-the-gaps.create') }}?exam={{ encrypt($exam->id) }}"
                               class="btn bg-gradient-primary float-right btn-hover-effect">
                                <i class="fas fa-pen-alt mr-1"></i>
                                Add Fill In The Gap</a>
                        @endif
                    </div><!-- /.card-header -->
                    @if($exam->fillInTheGaps()->count() === 20 && $exam->fillInTheGapOptions()->count() === 40)
                        <div class="progress">
                            <div class="progress-bar bg-success"
                                 role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0"
                                 aria-valuemax="100"></div>
                        </div>
                    @else
                        <div class="progress">
                            <div class="progress-bar bg-warning"
                                 role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0"
                                 aria-valuemax="100"></div>
                        </div>
                    @endif
                    <div class="card-body">
                        <div class="row">
                            @foreach($exam->sets as $set)
                                <?php
                                    $fillInTheGapsCountBySet = $exam->fillInTheGaps()->where('set_id', $set->id)->get()->count();
                                    $fillINTheGapOptionsCountBySet = $exam->fillInTheGapOptions()->where('set_id', $set->id)->get()->count();

                                    ?>
                                <div class="col-12 col-md-6 col-lg-3 count-section">
                                    <div class="info-box bg-white border {{ $fillInTheGapsCountBySet === 5 && $fillINTheGapOptionsCountBySet === 10? ' border-success': ' border-warning' }}">
                                    <span class="info-box-icon text-white {{ $fillInTheGapsCountBySet === 5 && $fillINTheGapOptionsCountBySet === 10? 'bg-success': 'bg-warning' }}"
                                          style="font-weight: 900">{{ $set->name }}</span>
                                        <div class="info-box-content">
                                            <span class="info-box-number font-weight-normal">{{ $fillInTheGapsCountBySet }} / 5 Fill In The Gap.</span>

                                            <div class="progress">
                                                <div class="progress-bar  {{ $fillInTheGapsCountBySet === 5 ? 'bg-success': 'bg-warning' }}"
                                                     style="width: {{ ($fillInTheGapsCountBySet*100)/5 }}%"></div>
                                            </div>
                                            <div class="progress-description">
                                                @if($fillInTheGapsCountBySet === 5)
                                                    @if($exam->fillInTheGapOptions()->where('set_id', $set->id)->get()->count() === 10)
                                                        <a href="{{ route('teachers.questions.fill-in-the-gaps.options.index') }}?exam={{ encrypt($exam->id) }}&set={{ encrypt($set->id) }}"
                                                           class="btn-link text-success"><i class="fas fa-check-circle mr-1"></i> View option</a>
                                                    @else
                                                        <a href="{{ route('teachers.questions.fill-in-the-gaps.options.create') }}?exam={{ encrypt($exam->id) }}&set={{ encrypt($set->id) }}"
                                                           class="btn-link"><i class="fas fa-pen-square"></i> Add options</a>
                                                    @endif
                                                @else
                                                    <a href="{{ route('teachers.questions.fill-in-the-gaps.create') }}?exam={{ encrypt($exam->id) }}&set={{ encrypt($set->id) }}"
                                                       class="btn-link"><i class="fas fa-pen-square"></i> Add Fill In The Gap                                                        Sentence</a>
                                                @endif
                                            </div>
                                        </div>
                                        <!-- /.info-box-content -->
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
                                        <th>Fill In The Gap</th>
                                        <th>Answer</th>
                                        <th>Set</th>
                                        <th>Exam</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($exam->fillInTheGaps()->orderByDesc('id')->get() as $index => $fillInTheGap)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td title="{{ $fillInTheGap->sentence }}">{{ Str::limit($fillInTheGap->sentence, 70) }}</td>
                                            <td title="{{ $fillInTheGap->answer->options }}">{{ Str::limit($fillInTheGap->answer->options, 20) }}</td>
                                            <td>{{ $fillInTheGap->set->name }}</td>
                                            <td title="{{ $fillInTheGap->exam->name }}">{{ Str::limit($fillInTheGap->exam->name, 40) }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('teachers.questions.fill-in-the-gaps.show', $fillInTheGap->id) }}?exam={{ encrypt($fillInTheGap->exam->id) }}&set={{ encrypt($fillInTheGap->set->id) }}"
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
                            <a href="{{ route('teachers.questions.fill-in-the-gaps.create') }}?exam={{ encrypt($exam->id) }}"
                               class="btn btn-lg mt-4 bg-gradient-primary"><i
                                    class="fas fa-pen-alt"></i> Add Fill In The Gap</a>
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

