<?php

namespace App\Http\Controllers\Student;

use App\Exam;
use App\Http\Controllers\Controller;
use App\Model\Grammar\Grammar;
use App\Model\Vocabulary\Combination\Combination;
use App\Model\Vocabulary\Definition\Definition;
use App\Model\Vocabulary\FillInTheGap\FillInTheGap;
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
                ->with('grammars', $exam->grammars()->where('set_id', $authStudent->set->id)->get());

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
            $authStudent = Auth::guard('student')->user();

            $checkResubmitGrammarQuestion = $authStudent->marks()->where('exam_id', $exam->id)->get()->first()->grammar;
            if ($checkResubmitGrammarQuestion === null) {

                // Store Student Grammar Answer
                foreach ($request->except('_token') as $index => $value) {
                    $authStudent->studentGrammars()->create([
                        'grammar_id' => $index,
                        'set_id' => $authStudent->set->id,
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
                $authStudent->marks()->where(['exam_id' => $exam->id, 'set_id' => $authStudent->set->id])->first()->update([
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

                ->with('synonyms', $exam->synonyms()->where('set_id', $authStudent->set->id)->get())
                ->with('synonymOptions', $exam->synonymOptions()->where('set_id', $authStudent->set->id)->get())

                ->with('definitions', $exam->definitions()->where('set_id', $authStudent->set->id)->get())
                ->with('definitionOptions', $exam->definitionOptions()->where('set_id', $authStudent->set->id)->get())

                ->with('combinations', $exam->combinations()->where('set_id', $authStudent->set->id)->get())
                ->with('combinationOptions', $exam->combinationOptions()->where('set_id', $authStudent->set->id)->get())

                ->with('fillInTheGaps', $exam->fillInTheGaps()->where('set_id', $authStudent->set->id)->get())
                ->with('fillInTheGapOptions', $exam->fillInTheGapOptions()->where('set_id', $authStudent->set->id)->get());

        } else {
            alert()->error('😒', 'You can\'t do this.');
            return redirect()->route('student.dashboard');
        }
    }

    public function submitVocabularyQuestion(Request $request, Exam $exam)
    {

        if ($this->validExamRequest($exam)) {
            $authStudent = Auth::guard('student')->user();

            $checkResubmitSynonym = $authStudent->marks()->where('exam_id', $exam->id)->get()->first()->synonym;
            $checkResubmitDefinition = $authStudent->marks()->where('exam_id', $exam->id)->get()->first()->definition;
            $checkResubmitCombination = $authStudent->marks()->where('exam_id', $exam->id)->get()->first()->combination;
            $checkResubmitFillInTheGap = $authStudent->marks()->where('exam_id', $exam->id)->get()->first()->fillInTheGap;

            if ($checkResubmitSynonym === null && $checkResubmitDefinition === null && $checkResubmitCombination === null && $checkResubmitFillInTheGap === null) {
                /**
                 * Synonym
                 */
                $authStudentSubmittedSynonymData = $request->input('synonym.*', []);
                foreach ($authStudentSubmittedSynonymData as $data) {
                    foreach ($data as $key => $value) {
                        $authStudent->studentSynonyms()->create([
                            'exam_id' => $exam->id,
                            'set_id' => $authStudent->set->id,
                            'synonym_id' => $key,
                            'answer' => $value
                        ]);
                    }
                }

                // Generate Synonym marks
                $marks = 0;
                foreach ($request->input('synonym.*', []) as $data) {
                    foreach ($data as $key => $value) {
                        $synonym = Synonym::find($key);
                        if ($synonym->answer->options == $value) {
                            $marks += 1;
                        }
                    }
                }
                $authStudent->marks()->where(['exam_id' => $exam->id, 'set_id' => $authStudent->set->id])->first()->update([
                    'synonym' => $marks
                ]);



                /**
                 * Definition
                 */
                $authStudentSubmittedSynonymData = $request->input('definition.*', []);
                foreach ($authStudentSubmittedSynonymData as $data) {
                    foreach ($data as $key => $value) {
                        $authStudent->studentDefinitions()->create([
                            'exam_id' => $exam->id,
                            'set_id' => $authStudent->set->id,
                            'definition_id' => $key,
                            'answer' => $value
                        ]);
                    }
                }

                // Generate definition marks
                $marks = 0;
                foreach ($request->input('definition.*', []) as $data) {
                    foreach ($data as $key => $value) {
                        $synonym = Definition::find($key);
                        if ($synonym->answer->options == $value) {
                            $marks += 1;
                        }
                    }
                }
                $authStudent->marks()->where(['exam_id' => $exam->id, 'set_id' => $authStudent->set->id])->first()->update([
                    'definition' => $marks
                ]);


                /**
                 * Combination
                 */
                $authStudentSubmittedCombinationData = $request->input('combination.*', []);
                foreach ($authStudentSubmittedCombinationData as $data) {
                    foreach ($data as $key => $value) {
                        $authStudent->studentCombinations()->create([
                            'exam_id' => $exam->id,
                            'set_id' => $authStudent->set->id,
                            'combination_id' => $key,
                            'answer' => $value
                        ]);
                    }
                }

                // Generate combination marks
                $marks = 0;
                foreach ($request->input('combination.*', []) as $data) {
                    foreach ($data as $key => $value) {
                        $combination = Combination::find($key);
                        if ($combination->answer->options == $value) {
                            $marks += 1;
                        }
                    }
                }
                $authStudent->marks()->where(['exam_id' => $exam->id, 'set_id' => $authStudent->set->id])->first()->update([
                    'combination' => $marks
                ]);




                /**
                 * fill in the gap
                 */
                $authStudentSubmittedFillInTheGapData = $request->input('fillInTheGap.*', []);
                foreach ($authStudentSubmittedFillInTheGapData as $data) {
                    foreach ($data as $key => $value) {
                        $authStudent->studentFillInTheGaps()->create([
                            'exam_id' => $exam->id,
                            'set_id' => $authStudent->set->id,
                            'fillInTheGap_id' => $key,
                            'answer' => $value
                        ]);
                    }
                }

                // Generate fillInTheGap marks
                $marks = 0;
                foreach ($request->input('fillInTheGap.*', []) as $data) {
                    foreach ($data as $key => $value) {
                        $fillInTheGap = FillInTheGap::find($key);
                        if ($fillInTheGap->answer->options == $value) {
                            $marks += 1;
                        }
                    }
                }
                $authStudent->marks()->where(['exam_id' => $exam->id, 'set_id' => $authStudent->set->id])->first()->update([
                    'fillInTheGap' => $marks
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
