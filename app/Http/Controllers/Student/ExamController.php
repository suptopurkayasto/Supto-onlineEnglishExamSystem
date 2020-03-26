<?php

namespace App\Http\Controllers\Student;

use App\Exam;
use App\GrammarQuestion;
use App\Http\Controllers\Controller;
use App\QuestionSet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ExamController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:student');
    }

    public function choseExamSubject(Exam $exam)
    {
        return view('student.exams.chose-exam-subject')
            ->with('exam', $exam);
    }


    public function showGrammarQuiz(Exam $exam)
    {
        $authStudentQuestionSet = Auth::guard('student')->user()->set;
        $grammarQuestions =  GrammarQuestion::all();
        return view('student.exams.questions.grammar-question', compact('authStudentQuestionSet', 'grammarQuestions', 'exam'));
    }

    public function GrammarQuizSubmit(Request $request, Exam $exam, $grammar)
    {
        $authStudentQuestionSet = Auth::guard('student')->user()->set;
        $array = [];
        foreach ($request->question as $item) {
            $array += [
              $item => $request->only('answer_'.$item)
            ];
        }

        return $array;
    }
}
