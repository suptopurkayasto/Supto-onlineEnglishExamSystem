@extends('layouts.teacher')

@section('title', 'All Exams')

@section('content')
    @if($exams->count() > 0)
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">All Exams</h3>
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
                        <th>Question Count</th>
                        <th>Exam Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($exams as $index => $exam)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td title="{{ $exam->name }}">{{ $exam->name }}</td>
                            <td>
                                <a href="{{ route('teachers.grammar-questions.index') }}">
                                    Grammar: {{ $exam->grammarQuestions()->count() }}
                                </a>
                            </td>
                            <td style="width: 220px !important;">
                                @if($exam->status === 'pending' || $exam->status === 'cancel')
                                    <form action="{{ route('teacher.exams.status', $exam->slug) }}" method="post"
                                          class="float-left">
                                        @method('PUT')
                                        @csrf
                                        <input type="hidden" name="status" value="running">
                                        <button type="submit" class="btn bg-gradient-indigo btn-sm"
                                                onclick="return confirm('Are you sure you want to start {{ $exam->name }} exam!')">
                                            Start Exam
                                        </button>
                                    </form>
                                @elseif($exam->status === 'running')
                                    <form action="{{ route('teacher.exams.status', $exam->slug) }}" method="post"
                                          class="float-right">
                                        @method('PUT')
                                        @csrf
                                        <input type="hidden" name="status" value="cancel">
                                        <button type="submit" class="btn bg-gradient-danger btn-sm"
                                                onclick="return confirm('Are you sure you want to cancel {{ $exam->name }} exam!')">
                                            Cancel Exam
                                        </button>
                                    </form>
                                    <form action="{{ route('teacher.exams.status', $exam->slug) }}" method="post"
                                          class="ml-3">
                                        @method('PUT')
                                        @csrf
                                        <input type="hidden" name="status" value="complete">
                                        <button type="submit" class="btn bg-gradient-success btn-sm"
                                                onclick="return confirm('Are you sure you want to start {{ $exam->name }} exam!')">
                                            Complete Exam
                                        </button>
                                    </form>
                                    @elseif($exam->status === 'complete')
                                    <strong class="text-success"><i class="fas fa-check"></i> Completed</strong>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('teacher.exams.show', $exam->slug) }}"
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
            <a href="{{ route('teacher.exams.create') }}" class="btn btn-lg mt-4 bg-gradient-primary">Add Exam</a>
        </div><!-- /.empty-data-section -->
    @endif
@endsection

@section('data-table-css')
    @include('partials.data-table-css')
@stop
@section('data-table-js')
    @include('partials.data-table-js')
@stop

