<?php

namespace App\Http\Controllers\Teacher\Question\Writing;

use App\Http\Controllers\Controller;
use App\Model\Writing\Dialog;
use Illuminate\Http\Request;

class WritingPartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:teacher');
        $this->middleware('teacher.profile');
    }

    public function index()
    {
        return view('teacher.questions.writing.index')
            ->with('dialogQuestions', Dialog::all());
    }

    public function create()
    {
        return view('teacher.questions.writing.create');
    }
}
