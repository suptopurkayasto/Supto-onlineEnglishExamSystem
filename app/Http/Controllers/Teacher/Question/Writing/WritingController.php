<?php

namespace App\Http\Controllers\Teacher\Question\Writing;

use App\Exam;
use App\Http\Controllers\Controller;
use App\Model\Writing\Dialog;
use App\Model\Writing\WritingPart;
use App\QuestionSet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WritingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:teacher');
        $this->middleware('teacher.profile');
    }

    public function index()
    {
        return view('teacher.questions.writing.index')
            ->with('authTeacherExams', Exam::where('teacher_id', Auth::guard('teacher')->id())->get())
            ->with('dialogQuestions', Dialog::all());
    }

    public function create()
    {
        return view('teacher.questions.writing.create')
            ->with('questionSets', QuestionSet::all())
            ->with('writingParts', WritingPart::orderBy('name')->get())
            ->with('authTeacherExams', Exam::where('teacher_id', Auth::guard('teacher')->id())->get());
    }
}
