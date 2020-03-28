<?php

namespace App\Http\Controllers\Student;

use App\Exam;
use App\Http\Controllers\Controller;
use App\Model\Grammar\StudentGrammarQuestionExamGotMarks;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:student');
    }
    public function index()
    {
        return view('student.dashboard')
            ->with('exams', Exam::all())
            ->with('authStudent', Auth::guard('student')->user());
    }
}
