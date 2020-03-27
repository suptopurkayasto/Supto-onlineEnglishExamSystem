<?php

namespace App\Http\Controllers\Student;

use App\Exam;
use App\GrammarQuestion;
use App\Http\Controllers\Controller;
use App\QuestionSet;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
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
            $student_answers = $request->only('answer_'.$item);
            $student_answer = '';
            foreach ($student_answers as $student_answerOption) {
                $student_answer = $student_answerOption;
            }
            $correct_answer = GrammarQuestion::find($item)->answer;

            GrammarQuestion\StudentGrammarQuestion::create([
                'student_id' => Auth::guard('student')->user()->id,
                'question_set_id' => $authStudentQuestionSet->id,
                'grammar_question_id' => $item,
                'student_answer' => $student_answer == '' ? null : $student_answer ,
                'correct_answer' => $correct_answer
            ]);
        }
    }
}
