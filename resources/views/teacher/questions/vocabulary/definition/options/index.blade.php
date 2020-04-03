@extends('layouts.teacher')

@section('title', 'All Definition Sentence Options')

@section('content')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                Definition Sentence Options
            </h3>
        </div><!-- /.card-header -->
        <div class="card-body">
            <div class="col-12">
                <table
                    id="example"
                    class="table table-striped table-bordered dt-responsive nowrap border-0 table-hover custom-table-style"
                    style="width: 100%">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Option</th>
                        <th>Definition Sentence</th>
                        <th>Exam</th>
                        <th>Set</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($options as $index => $option)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td title="{{ $option->options }}">{{ Str::limit($option->options, 70) }}</td>
                            <td title="{{ $option->definition === null ? 'Extra Options' : $option->definition->sentence, 30 }}">{{ $option->definition === null ? 'Extra Options' : Str::limit($option->definition->sentence, 30) }}</td>
                            <td>{{ Str::limit($option->exam->name, 30) }}</td>
                            <td>{{ $option->set->name }}</td>
                            <td class="text-center">
                                <a href="{{ route('teachers.questions.definitions.options.show', $option->id) }}?exam={{ request()->get('exam') }}&set={{ request()->get('set') }}"
                                   class="btn btn-primary btn-sm btn-block btn-hover-effect"><i
                                        class="fas fa-eye mr-1"></i> View</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div><!-- /.col-12 -->
        </div><!-- /.card-body -->
    </div><!-- /.card -->

@endsection

@section('data-table-css')
    @include('partials.data-table-css')
@stop
@section('data-table-js')
    @include('partials.data-table-js')
@stop

