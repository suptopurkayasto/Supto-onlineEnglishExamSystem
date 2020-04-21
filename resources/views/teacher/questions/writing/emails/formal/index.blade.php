@extends('layouts.teacher')

@section('title', 'All Formal Email')

@section('content')

    @if($authTeacher->exams()->count())
        @foreach($authTeacher->exams as $exam)
            @if($exam->formalEmails()->count() > 0)
                <div class="card mb-5 index-card">
                    <div class="card-header">
                        <h3 class="card-title index-card-title float-left {{ $exam->formalEmails()->count() === 4 ? 'text-success' : 'text-warning' }}" title="{{ $exam->name }}">
                            <span>{{ Str::limit($exam->name, 30) }}</span>
                            <span class="font-weight-bolder ml-2">Formal Email</span>
                            @if($exam->formalEmails()->count() === 4)
                                <i class="fas fa-check-circle"></i>
                            @endif

                        </h3>
                        @if($exam->formalEmails()->count() !== 4)
                            <a href="{{ route('teachers.questions.formal-email.create') }}?exam={{ encrypt($exam->id) }}"
                               class="btn btn-primary float-right btn-hover-effect"><i class="fas fa-pen-alt mr-1"></i> Add
                                Formal Email</a>
                        @endif
                    </div><!-- /.card-header -->
                    @if($exam->formalEmails()->count() === 4)
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
                        <div class="row count-section">
                            @foreach($exam->sets as $set)
                                @php $formalEmailCountBySet = $exam->formalEmails()->where('set_id', $set->id)->get()->count() @endphp
                                <div class="col-12 col-md-6 col-lg-3">
                                    <div class="info-box bg-white border {{ $formalEmailCountBySet === 1 ? ' border-success': ' border-warning' }}">
                                    <span class="info-box-icon text-white {{ $formalEmailCountBySet === 1 ? 'bg-success': 'bg-warning' }}"
                                          style="font-weight: 900">{{ $set->name }}</span>
                                        <div class="info-box-content">
                                            <span
                                                class="info-box-number">{{ $formalEmailCountBySet }} Email</span>

                                            <div class="progress">
                                                <div class="progress-bar bg-success"
                                                     style="width: {{ ($formalEmailCountBySet*100)/1 }}%"></div>
                                            </div>
                                            <span class="progress-description">
                                                @if($formalEmailCountBySet < 1)
                                                    <a href="{{ route('teachers.questions.formal-email.create') }}?exam={{ encrypt($exam->id) }}&set={{ encrypt($set->id)}}"
                                                       class="btn-link"><i class="fas fa-pen-square"></i> Add formal email</a>
                                                @else
                                                    <span class="text-success"><i class="fas fa-check-circle"></i> Done</span>
                                                @endif
                                            </span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                </div><!-- /.col -->
                            @endforeach
                            <div class="col-12">
                                @if($exam->formalEmails()->count() > 0)
                                    <table id=""
                                           class="table table-striped table-bordered dt-responsive nowrap border-0 table-hover custom-table-style"
                                           style="width: 100%">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Topic</th>
                                            <th>Received Email</th>
                                            <th>Set</th>
                                            <th>Exam</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($exam->formalEmails()->orderByDesc('id')->get() as $index => $formalEmail)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td title="{{ $formalEmail->topic }}">{{ Str::limit($formalEmail->topic, 50) }}</td>
                                                <td title="{{ $formalEmail->received_email }}">{{ Str::limit($formalEmail->received_email, 60) }}</td>
                                                <td>{{ $formalEmail->set->name }}</td>
                                                <td title="{{ $formalEmail->exam->name }}">{{ Str::limit($formalEmail->exam->name, 40) }}</td>
                                                <td class="text-center">
                                                    <a href="{{ route('teachers.questions.formal-email.show', $formalEmail->id) }}?exam={{ encrypt($formalEmail->exam->id) }}"
                                                       class="btn btn-primary btn-sm btn-block btn-hover-effect"><i
                                                            class="fas fa-eye mr-1"></i> View</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <div class="text-center">
                                        <h2 class="text-center text-warning display-4">Empty.</h2>
                                        <a href="{{ route('teachers.questions.formal-email.create') }}?exam={{ $exam->slug }}"
                                           class="btn btn-hover-effect mb-4 bg-gradient-primary"><i
                                                class="fas fa-pen-alt"></i> Add Formal Email</a>
                                    </div><!-- /.text-center -->
                                @endif
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
                            <a href="{{ route('teachers.questions.formal-email.create') }}?exam={{ encrypt($exam->id) }}"
                               class="btn btn-lg mt-4 bg-gradient-primary"><i
                                    class="fas fa-pen-alt"></i> Add Formal Email</a>
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
                    <a href="{{ route('teacher.exams.create') }}"
                       class="btn btn-lg mt-4 bg-gradient-primary"><i
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

