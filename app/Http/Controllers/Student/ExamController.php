<?php

namespace App\Http\Controllers\Student;

use App\Exam;
use App\Http\Controllers\Controller;
use App\Model\Grammar\Grammar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{
    public function showTopic(Exam $exam)
    {
        if ($this->validExamRequest($exam)) {
            return view('student.exam.show-topic', compact('exam'));
        } else {
            alert()->error('😒', 'You can\'t do this.');
            return redirect()->route('student.dashboard');
        }
    }

    public function showGrammarQuestion(Exam $exam)
    {
        if ($this->validExamRequest($exam)) {
            $authStudent = Auth::guard('student')->user();
            return view('student.exam.question.show-grammar-question', compact('exam'))
                ->with('grammars', Grammar::where('question_set_id', $authStudent->set->id)->get());

        } else {
            alert()->error('😒', 'You can\'t do this.');
            return redirect()->route('student.dashboard');
        }
    }

    public function submitGrammarQuestion(Request $request, Exam $exam)
    {
        if ($this->validExamRequest($exam)) {

            return $request->all();

        } else {
            alert()->error('😒', 'You can\'t do this.');
            return redirect()->route('student.dashboard');
        }
    }


    /**
     * @param Exam $exam
     * @return bool
     */
    private function validExamRequest(Exam $exam)
    {
        if ($exam->status === 'running') {
            return true;
        } else {
            return false;
        }
    }
}
