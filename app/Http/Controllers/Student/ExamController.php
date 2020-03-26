<?php

namespace App\Http\Controllers\Student;

use App\Exam;
use App\GrammarQuestion;
use App\Http\Controllers\Controller;
use App\QuestionSet;
use Illuminate\Http\Request;
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


    public function showGrammarQuiz()
    {
        $questionSet = QuestionSet::all()->random();
        $grammarQuestions =  GrammarQuestion::all();
        return view('student.exams.questions.grammar-question', compact('questionSet', 'grammarQuestions'));
    }

    public function showQuiz(Request $request, Exam $exam)
    {
        $data = $this->validate($request, ['exam_subject' => 'required|string|max:255']);

        $questionSet = QuestionSet::all()->random();

        if (Str::lower($data['exam_subject']) === 'grammar') {
            $grammarQuestions =  GrammarQuestion::all();
            return view('student.exams.questions.grammar-question', compact('questionSet', 'grammarQuestions'));
        } else {
            return true;
        }

    }
}
