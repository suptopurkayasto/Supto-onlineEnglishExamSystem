@extends('layouts.teacher')

@section('title', 'Dashboard')


@section('content')

    @auth('teacher')
        @if(!auth()->guard('teacher')->user()->profile_status)
            <div class="profile_pending_section text-center">
                <h2>Sorry, Your profile is pending...</h2>
                <small class="text-gray">With for approve profile</small>
            </div><!-- /. -->
        @endif
    @endauth

@endsection

