@extends('layouts.teacher')

@section('title', 'All Rearranges')

@section('content')
    @if($authTeacher->exams()->count() > 0)
        @foreach($authTeacher->exams as $exam)
            @if($exam->rearranges()->count() > 0)
                <div class="card mb-5">
                    <div
                        class="card-header">
                        <h3 class="card-title float-left index-card-title {{ $exam->rearranges()->count() === 4 ? 'text-success' : 'text-warning' }}"
                            title="{{ $exam->name }}"><span
                                class="">{{ Str::limit($exam->name, 30) }}</span>
                            <span class="font-weight-bolder">Rearranges</span>
                            @if($exam->rearranges()->count() === 4)
                                <span class="text-success ml-2" title="Ready For Exam">
                                    <i class="fas fa-check-circle"></i>
                                </span>
                            @endif
                        </h3>
                        @if($exam->rearranges()->count() !== 4)
                            <a href="{{ route('teachers.questions.rearranges.create') }}?exam={{ encrypt($exam->id) }}"
                               class="btn bg-gradient-primary float-right btn-hover-effect">
                                <i class="fas fa-pen-alt mr-1"></i>
                                Add Rearrange</a>
                        @endif
                    </div><!-- /.card-header -->
                    @if($exam->rearranges()->count() === 4)
                        <div class="progress" style="height: 7px">
                            <div class="progress-bar  bg-success"
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
                                @php $rearrangeCountBySet = $exam->rearranges()->where('question_set_id', $set->id)->get()->count() @endphp
                                <div class="col-12 col-md-6 col-lg-3 count-section">
                                    <div class="info-box bg-white border-primary border">
                                    <span class="info-box-icon text-primary"
                                          style="font-weight: 900">{{ $set->name }}</span>
                                        <div class="info-box-content">
                                            <span class="info-box-number font-weight-normal">{{ $rearrangeCountBySet }} / 1 Rearrange.</span>

                                            <div class="progress">
                                                <div class="progress-bar"
                                                     style="width: {{ ($rearrangeCountBySet*100)/1 }}%"></div>
                                            </div>
                                            <div class="progress-description">
                                                @if($rearrangeCountBySet < 1)
                                                    <a href="{{ route('teachers.questions.rearranges.create') }}?exam={{ encrypt($exam->id) }}&set={{ encrypt($set->id) }}"
                                                       class="btn-link btn-block"><i class="fas fa-pen mr-1"></i> Add
                                                        Rearrange</a>
                                                @else
                                                    <span class="text-success"><i class="fas fa-check-circle mr-1"></i> Done.</span>
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
                                        <th>First Line</th>
                                        <th>Set</th>
                                        <th>Exam</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($exam->rearranges as $index => $rearrange)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td title="{{ $rearrange->line_1 }}">{{ Str::limit($rearrange->line_1, 90) }}</td>
                                            <td>{{ $rearrange->set->name }}</td>
                                            <td title="{{ $rearrange->exam->name }}">{{ Str::limit($rearrange->exam->name, 40) }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('teachers.questions.rearranges.show', $rearrange->id) }}?exam={{ encrypt($rearrange->exam->id) }}"
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
                            <a href="{{ route('teachers.questions.rearranges.create') }}?exam={{ encrypt($exam->id) }}"
                               class="btn btn-lg mt-4 bg-gradient-primary"><i
                                    class="fas fa-pen-alt"></i> Add Rearrange</a>
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

