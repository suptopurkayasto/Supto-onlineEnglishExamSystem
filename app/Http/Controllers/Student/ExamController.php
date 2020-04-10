<?php

namespace App\Http\Controllers\Student;

use App\Exam;
use App\Http\Controllers\Controller;
use App\Model\Grammar\Grammar;
use App\Model\Vocabulary\Synonym\Synonym;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ExamController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:student');
    }
    /**
     * @param Exam $exam
     * @return Factory|RedirectResponse|View
     */
    public function showTopic(Exam $exam)
    {
        if ($this->validExamRequest($exam)) {
            return view('student.exam.show-topic', compact('exam'))
                ->with('authStudent', Auth::guard('student')->user());
        } else {
            alert()->error('😒', 'You can\'t do this.');
            return redirect()->route('student.dashboard');
        }
    }


    /**
     * @param Exam $exam
     * @return Factory|RedirectResponse|View
     */
    public function showGrammarQuestion(Exam $exam)
    {
        if ($this->validExamRequest($exam)) {
            $authStudent = Auth::guard('student')->user();
            return view('student.exam.question.show-grammar-question', compact('exam'))
                ->with('grammars', $exam->grammars()->where('question_set_id', $authStudent->set->id)->get());

        } else {
            alert()->error('😒', 'You can\'t do this.');
            return redirect()->route('student.dashboard');
        }
    }

    /**
     * @param Request $request
     * @param Exam $exam
     * @return array|RedirectResponse
     */
    public function submitGrammarQuestion(Request $request, Exam $exam)
    {
        if ($this->validExamRequest($exam)) {
            $student = Auth::guard('student')->user();

            $checkStudentGrammarSubmit = $student->studentGrammars()->where('exam_id', $exam->id)->get()->count();
            if ($checkStudentGrammarSubmit === 0) {
                // Store Student Grammar Answer
                foreach ($request->except('_token') as $index => $value) {
                    $student->studentGrammars()->create([
                        'grammar_id' => $index,
                        'question_set_id' => $student->set->id,
                        'exam_id' => $exam->id,
                        'answer' => $value
                    ]);
                }


                // Generate grammar marks
                $marks = 0;
                foreach ($request->except('_token') as $index => $value) {
                    $grammar = Grammar::find($index);
                    if ($grammar->answer == $value) {
                        $marks += 1;
                    }
                }
                $student->marks()->create([
                    'exam_id' => $exam->id,
                    'question_set_id' => $student->set->id,
                    'grammar' => $marks
                ]);
            } else {
                alert()->error('😒', 'You will no longer be able to resubmit');
                return redirect()->route('student.exam.show.topic', $exam->id);
            }

        } else {
            alert()->error('😒', 'You can\'t do this.');
            return redirect()->route('student.dashboard');
        }
    }



    //

    public function showVocabularyQuestion(Exam $exam)
    {
        if ($this->validExamRequest($exam)) {
            $authStudent = Auth::guard('student')->user();
            return view('student.exam.question.show-vocabulary-question', compact('exam'))
                ->with('synonyms', $exam->synonyms()->where('question_set_id', $authStudent->set->id)->get())
                ->with('synonymOptions', $exam->synonymOptions()->where('question_set_id', $authStudent->set->id)->get());

        } else {
            alert()->error('😒', 'You can\'t do this.');
            return redirect()->route('student.dashboard');
        }
    }

    public function submitVocabularyQuestion(Request $request, Exam $exam)
    {

        if ($this->validExamRequest($exam)) {
            $authStudent = Auth::guard('student')->user();

            $checkStudentSynonymSubmit = $authStudent->studentSynonyms()->where('exam_id', $exam->id)->get()->count();
            if ($checkStudentSynonymSubmit === 0) {
                // Store Student submitted Synonym data
                $studentSubmittedSynonymData = $request->input('synonym.*');
                foreach ($studentSubmittedSynonymData as $data) {
                    foreach ($data as $key => $value) {
                        $authStudent->studentSynonyms()->create([
                            'exam_id' => $exam->id,
                            'question_set_id' => $authStudent->set->id,
                            'synonym_id' => $key,
                            'answer' => $value
                        ]);
                    }
                }

                // Generate Synonym marks
                $marks = 0;
                foreach ($request->input('synonym.*') as $data) {
                    foreach ($data as $key => $value) {
                        $synonym = Synonym::find($key);
                        if ($synonym->answer->options == $value) {
                            $marks += 1;
                        }
                    }
                }
                $authStudent->marks()->create([
                    'exam_id' => $exam->id,
                    'question_set_id' => $authStudent->set->id,
                    'synonym' => $marks
                ]);
            } else {
                alert()->error('😒', 'You will no longer be able to resubmit');
                return redirect()->route('student.exam.show.topic', $exam->id);
            }

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
