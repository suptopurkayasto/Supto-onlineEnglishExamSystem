<?php

namespace App\Http\Controllers\Student;

use App\Exam;
use App\Http\Controllers\Controller;
use App\Model\Grammar\GrammarQuestion;
use App\Model\Grammar\StudentGrammarQuestion;
use App\Model\Grammar\StudentGrammarQuestionExamGotMarks;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:student');
    }

    public function choseExamSubject(Exam $exam)
    {
        if ($exam->status != 'running') {
            return redirect()->route('student.dashboard');
        }

        $authStudentExamGrammarAbility = Collection::make(StudentGrammarQuestionExamGotMarks::where(['exam_id' => $exam->id, 'student_id' => Auth::guard('student')->id()])->get());

        $showGrammarQuestionLink = null;
        if ($authStudentExamGrammarAbility->count() < 1) {
            $showGrammarQuestionLink = true;
        } else {
            $showGrammarQuestionLink = false;
        }

        return view('student.exams.chose-exam-subject', compact('showGrammarQuestionLink'))
            ->with('exam', $exam);
    }


    public function showGrammarQuiz(Exam $exam)
    {
        if ($exam->status != 'running') {
            return redirect()->route('student.dashboard');
        }
        $authStudentQuestionSet = Auth::guard('student')->user()->set;
        $grammarQuestions = GrammarQuestion::all();
        return view('student.exams.questions.grammar-question', compact('authStudentQuestionSet', 'grammarQuestions', 'exam'));
    }

    public function GrammarQuizSubmit(Request $request, Exam $exam, $grammar)
    {

        $submitAbility = StudentGrammarQuestionExamGotMarks::where(['exam_id' => $exam->id, 'student_id' => Auth::guard('student')->id()])->get();


        if (Collection::make($submitAbility)->count() < 1) {

            $authStudentQuestionSet = Auth::guard('student')->user()->set;

            foreach ($request->question as $item) {
                $student_answers = $request->only('answer_' . $item);
                $student_answer = '';
                foreach ($student_answers as $student_answerOption) {
                    $student_answer = $student_answerOption;
                }
                $correct_answer = GrammarQuestion::find($item)->answer;

                StudentGrammarQuestion::create([
                    'student_id' => Auth::guard('student')->user()->id,
                    'exam_id' => $exam->id,
                    'question_set_id' => $authStudentQuestionSet->id,
                    'grammar_question_id' => $item,
                    'student_answer' => $student_answer == '' ? null : $student_answer,
                    'correct_answer' => $correct_answer
                ]);
            }

            $got_marks = 0;

            foreach (StudentGrammarQuestion::all() as $item) {
                if ($item->correct_answer === $item->student_answer) {
                    $got_marks = $got_marks + 1;
                }
            };

            StudentGrammarQuestionExamGotMarks::create([
                'student_id' => Auth::guard('student')->id(),
                'exam_id' => $exam->id,
                'got_marks' => $got_marks,

            ]);

            alert('Success!', 'Your answer has been successfully submitted', 'success');
        } else {
            alert()->info('Already Submitted!', 'You can no longer submit.', 'info');
        }
        session()->flash('success_audio');
        return redirect()->route('student.exam.subject', $exam->slug);

    }
}
