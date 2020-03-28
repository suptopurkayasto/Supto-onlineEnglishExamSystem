@extends('layouts.teacher')

@section('title', 'All Writing Questions')

@section('content')
    @if($authTeacherExams->count() > 0)

        @foreach($authTeacherExams as $authTeacherExam)
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><span class="text-uppercase">{{ $authTeacherExam->name }}</span>
                        ( <strong
                            class="{{ $authTeacherExam->dialogs()->count() === 4 ? 'text-success' : 'text-danger' }}">
                            Writing
                            @if($authTeacherExam->dialogs()->count() === 4)
                                <i class="fas fa-check"></i>
                            @endif
                        </strong>
                        )
                    </h3>
                </div><!-- /.card-header -->
                <div class="card-body">
                    <div class="p-3 pt-0 shadow-sm mb-5 count-section bg-white rounded border-top border-primary">
                        <div class="row">
                        {{--                    <div class="col-12">--}}
                        {{--                        <div class="info-box bg-white info-box-main border-primary border">--}}
                        {{--                            <span class="info-box-icon text-primary"><i class="fa-2x fas fa-question"></i></span>--}}
                        {{--                            <div class="info-box-content">--}}
                        {{--                                <span class="info-box-text">Total Grammar Questions</span>--}}
                        {{--                                <span class="info-box-number"><strong>{{ $authTeacherExam->grammarQuestions()->count() }}</strong> questions</span>--}}

                        {{--                                <div class="progress">--}}
                        {{--                                    <div class="progress-bar"--}}
                        {{--                                         style="width: {{ ($authTeacherExam->grammarQuestions()->count()*100)/100 }}%"></div>--}}
                        {{--                                </div>--}}
                        {{--                                <span class="progress-description">--}}
                        {{--                            {{ $authTeacherExam->grammarQuestions()->count() }} questions of 100 questions--}}
                        {{--                            </span>--}}
                        {{--                            </div>--}}
                        {{--                            <!-- /.info-box-content -->--}}
                        {{--                        </div>--}}
                        {{--                    </div><!-- /.col -->--}}

                        <!-- Dialog -->
                            <div class="col-12">
                                <h4 class="h4 font-weight-bold {{ $authTeacherExam->dialogs()->count() === 4 ? 'text-success' : 'text-warning' }}">
                                    Dialog
                                    @if($authTeacherExam->dialogs()->count() === 4)
                                        <i class="fas fa-check"></i>
                                    @endif
                                </h4>
                            </div><!-- /.col-12 -->

                            @foreach($authTeacherExam->sets as $set)
                                @php $dialogCountBySet = $authTeacherExam->dialogs()->where('question_set_id', $set->id)->get()->count() @endphp
                                <div class="col-12 col-md-6 col-lg-3">
                                    <div class="info-box bg-white border-primary border">
                                    <span class="info-box-icon text-primary"
                                          style="font-weight: 900">{{ $set->name }}</span>
                                        <div class="info-box-content">
                                            <span class="info-box-number">{{ $dialogCountBySet }} Dialog</span>

                                            <div class="progress">
                                                <div class="progress-bar" style="width: {{ ($dialogCountBySet*100)/1 }}%"></div>
                                            </div>
                                            <span class="progress-description">
                                        {{ $dialogCountBySet }} / 1 dialog
                                    </span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                </div><!-- /.col -->
                            @endforeach

                        </div><!-- /.row -->
                    </div><!-- /.p-4 shadow -->
                </div><!-- /.card-body -->
            </div><!-- /.card -->
        @endforeach



        <div class="card">
            <div class="card-header">
                <h3 class="card-title float-left">All Students</h3>
                <a href="{{ route('teachers.questions.writing.create') }}" class="btn btn-primary float-right">Add
                    Dialog</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example"
                       class="table table-striped table-bordered dt-responsive nowrap border-0 table-hover custom-table-style"
                       style="width: 100%">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($dialogQuestions as $index => $dialogQuestion)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td title="{{ $dialogQuestion->topic }}">{{ Str::limit($dialogQuestion->topic, 20) }}</td>
                            <td class="text-center">
                                <a href="{{ route('teacher.students.show', $dialogQuestion->id) }}"
                                   class="btn btn-primary btn-sm btn-block btn-hover-effect">View</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    @else
        <div class="empty-data-section">
            <h2 class="text-center text-warning mt-5 display-1 font-weight">Empty.</h2>
            <a href="{{ route('teachers.questions.writing.create') }}" class="btn btn-lg mt-4 bg-gradient-primary"><i
                    class="fas fa-pen-alt"></i> Add Writing Question</a>
        </div><!-- /.empty-data-section -->
    @endif
@endsection

@section('data-table-css')
    @include('partials.data-table-css')
@stop
@section('data-table-js')
    @include('partials.data-table-js')
@stop

