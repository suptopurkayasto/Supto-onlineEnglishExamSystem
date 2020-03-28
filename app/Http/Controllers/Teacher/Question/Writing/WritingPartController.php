<?php

namespace App\Http\Controllers\Teacher\Question\Writing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WritingPartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:teacher');
        $this->middleware('teacher.profile');
    }

    public function create()
    {
        return view('teacher.questions.writing.create');
    }
}
