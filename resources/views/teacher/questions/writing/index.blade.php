@extends('layouts.teacher')

@section('title', 'All Writing Questions')

@section('content')
    @if($dialogQuestions->count() > 0)
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">All Students</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example" class="table table-striped table-bordered dt-responsive nowrap border-0 table-hover custom-table-style" style="width: 100%">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>ID Number</th>
                        <th>Name</th>
                        <th>Group</th>
                        <th>Section</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($dialogQuestions as $index => $dialogQuestion)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td title="{{ 'ID Number: ' . $dialogQuestion->id_number }}">{{ $dialogQuestion->id_number }}</td>
                            <td title="{{ $dialogQuestion->name }}">{{ Str::limit($dialogQuestion->name, 20) }}</td>
                            <td title="{{ 'Group: ' . $dialogQuestion->group->name }}">{{ $dialogQuestion->group->name }}</td>
                            <td title="{{ 'Section: ' . $dialogQuestion->section->name }}">{{ $dialogQuestion->section->name }}</td>
                            <td title="{{ $dialogQuestion->email }}">{{ Str::limit($dialogQuestion->email, 30) }}</td>
                            <td class="text-center">
                                <a href="{{ route('teacher.students.show', $dialogQuestion->id_number) }}"
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
            <a href="{{ route('teachers.writing.create') }}" class="btn btn-lg mt-4 bg-gradient-primary"><i class="fas fa-pen-alt"></i> Add Writing Question</a>
        </div><!-- /.empty-data-section -->
    @endif
@endsection

@section('data-table-css')
    @include('partials.data-table-css')
@stop
@section('data-table-js')
    @include('partials.data-table-js')
@stop

