<?php

namespace App\Http\Controllers\Student;

use App\Exam;
use App\Http\Controllers\Controller;
use App\Model\Grammar\Grammar;
use App\Model\Reading\Heading\Heading;
use App\Model\Vocabulary\Combination\Combination;
use App\Model\Vocabulary\Definition\Definition;
use App\Model\Vocabulary\FillInTheGap\FillInTheGap;
use App\Model\Vocabulary\Synonym\Synonym;
use Illuminate\Contracts\Foundation\Application;
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
                foreach ($request->input('grammar', []) as $index => $value) {
                    $authStudent->studentGrammars()->create([
                        'grammar_id' => $index,
                        'set_id' => $authStudent->set->id,
                        'exam_id' => $exam->id,
                        'answer' => $value
                    ]);
                }


                // Generate grammar marks
                $marks = 0;
                foreach ($request->input('grammar', []) as $index => $value) {
                    $grammar = Grammar::find($index);
                    if ($grammar->answer == $value) {
                        $marks += 1;
                    }
                }
                $authStudent->marks()->where(['exam_id' => $exam->id, 'set_id' => $authStudent->set->id])->first()->update([
                    'grammar' => $marks
                ]);

                toast('Grammar part has been successfully submitted', 'success');
                session()->flash('success_audio');
                return redirect()->route('student.exam.show.topic', $exam->id);

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
     * @return Application|Factory|RedirectResponse|View
     */
    public function showVocabularyQuestion(Exam $exam)
    {
        if ($this->validExamRequest($exam)) {
            $authStudent = Auth::guard('student')->user();
            return view('student.exam.question.show-vocabulary-question', compact('exam'))

                ->with('synonyms', $exam->synonyms()->where('set_id', $authStudent->set->id)->get())
                ->with('synonymOptions', $exam->synonymOptions()->where('set_id', $authStudent->set->id)->orderBy('options')->get())

                ->with('definitions', $exam->definitions()->where('set_id', $authStudent->set->id)->get())
                ->with('definitionOptions', $exam->definitionOptions()->where('set_id', $authStudent->set->id)->orderBy('options')->get())

                ->with('combinations', $exam->combinations()->where('set_id', $authStudent->set->id)->get())
                ->with('combinationOptions', $exam->combinationOptions()->where('set_id', $authStudent->set->id)->orderBy('options')->get())

                ->with('fillInTheGaps', $exam->fillInTheGaps()->where('set_id', $authStudent->set->id)->get())
                ->with('fillInTheGapOptions', $exam->fillInTheGapOptions()->where('set_id', $authStudent->set->id)->orderBy('options')->get());

        } else {
            alert()->error('😒', 'You can\'t do this.');
            return redirect()->route('student.dashboard');
        }
    }

    /**
     * @param Request $request
     * @param Exam $exam
     * @return RedirectResponse
     */
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
                toast('Vocabulary part has been successfully submitted', 'success');
                session()->flash('success_audio');
                return redirect()->route('student.exam.show.topic', $exam->id);

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
     * @return Application|Factory|RedirectResponse|View
     */
    public function showReadingQuestion(Exam $exam)
    {
        if ($this->validExamRequest($exam)) {
            $authStudent = Auth::guard('student')->user();
            return view('student.exam.question.show-reading-question', compact('exam'))
                ->with('headings', $exam->headings()->where('set_id', $authStudent->set->id)->get())
                ->with('headingOptions', $exam->headingOptions()->where('set_id', $authStudent->set->id)->orderBy('headings')->get())
                ->with('rearranges', $exam->rearranges()->where('set_id', $authStudent->set->id)->get());

        } else {
            alert()->error('😒', 'You can\'t do this.');
            return redirect()->route('student.dashboard');
        }
    }

    /**
     * @param Request $request
     * @param Exam $exam
     * @return RedirectResponse
     */
    public function submitReadingQuestion(Request $request, Exam $exam)
    {
        if ($this->validExamRequest($exam)) {
            $authStudent = Auth::guard('student')->user();



            $checkResubmitHeading = $authStudent->marks()->where('exam_id', $exam->id)->get()->first()->heading;
            $checkResubmitRearrange = $authStudent->marks()->where('exam_id', $exam->id)->get()->first()->rearrange;

            if ($checkResubmitRearrange === null && $checkResubmitHeading === null) {


                /**
                 * Heading
                 */
                foreach ($request->input('heading.*', []) as $headings) {
                    foreach ($headings as $index => $value) {
                        $authStudent->studentHeadings()->create([
                            'exam_id' => $exam->id,
                            'set_id' => $authStudent->set->id,
                            'heading_id' => $index,
                            'heading_option_id' => $value
                        ]);
                    }
                }

                // Generate rearrange marks
                $authStudentSubmittedHeadings = $authStudent->studentHeadings()->where(['exam_id' => $exam->id, 'set_id' => $authStudent->set->id])->get();

                $marks = 0;
                foreach ($authStudentSubmittedHeadings as $authStudentSubmittedHeading) {
                    $heading = Heading::find($authStudentSubmittedHeading->heading->id);
                    if ($authStudentSubmittedHeading->heading_option_id === $heading->heading_option_id) {
                        $marks += 1;
                    }
                }
                $authStudent->marks()->where(['exam_id' => $exam->id, 'set_id' => $authStudent->set->id])->first()->update([
                    'heading' => $marks
                ]);



                /**
                 * Rearrange
                 */
                // Store Student submitted Rearrange data
                $authStudent->studentRearranges()->create([
                    'exam_id' => $exam->id,
                    'set_id' => $authStudent->set->id,
                    'line_1' => $request->input('1'),
                    'line_2' => $request->input('2'),
                    'line_3' => $request->input('3'),
                    'line_4' => $request->input('4'),
                    'line_5' => $request->input('5'),
                    'line_6' => $request->input('6'),
                    'line_7' => $request->input('7'),
                ]);

                // Generate rearrange marks
                $authStudentSubmittedRearrange = $authStudent->studentRearranges()->where(['exam_id' => $exam->id, 'set_id' => $authStudent->set->id])->get()->first();
                $rearrangeForAuthStudent = $exam->rearranges()->where('set_id', $authStudent->set->id)->get()->first();

                $rearrangeMarks = 0;
                for ($number = 1; $number <= 7; $number++) {
                    if ($authStudentSubmittedRearrange["line_$number"] === $rearrangeForAuthStudent["line_$number"]) {
                        $rearrangeMarks += 1;
                    }
                }
                $authStudent->marks()->where(['exam_id' => $exam->id, 'set_id' => $authStudent->set->id])->first()->update([
                    'rearrange' => $rearrangeMarks
                ]);


                toast('Reading part has been successfully submitted', 'success');
                session()->flash('success_audio');
                return redirect()->route('student.exam.show.topic', $exam->id);

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
     * @return Application|Factory|RedirectResponse|View
     */
    public function showWritingQuestion(Exam $exam)
    {
        if ($this->validExamRequest($exam)) {
            $authStudent = Auth::guard('student')->user();
            return view('student.exam.question.show-writing-question', compact('exam'))
                ->with('dialog', $exam->dialogs()->where('set_id', $authStudent->set->id)->get()->first())
                ->with('informalEmail', $exam->informalEmails()->where('set_id', $authStudent->set->id)->get()->first())
                ->with('formalEmail', $exam->formalEmails()->where('set_id', $authStudent->set->id)->get()->first())
                ->with('sortQuestions', $exam->sortQuestions()->where('set_id', $authStudent->set->id)->get());
        } else {
            alert()->error('😒', 'You can\'t do this.');
            return redirect()->route('student.dashboard');
        }
    }



    public function submitWritingQuestion(Request $request, Exam $exam)
    {
        if ($this->validExamRequest($exam)) {

            $authStudent = Auth::guard('student')->user();

            $checkResubmitDialog = $authStudent->marks()->where('exam_id', $exam->id)->get()->first()->dialog;
            $checkResubmitInformalEmail = $authStudent->marks()->where('exam_id', $exam->id)->get()->first()->informalEmail;
            $checkResubmitFormalEmail = $authStudent->marks()->where('exam_id', $exam->id)->get()->first()->formalEmail;
            $checkResubmitSortQuestion = $authStudent->marks()->where('exam_id', $exam->id)->get()->first()->sortQuestion;

            if ($checkResubmitDialog === null && $checkResubmitInformalEmail === null && $checkResubmitFormalEmail === null && $checkResubmitSortQuestion === null) {

                // Store student submitted dialog
                $exam->studentDialogs()->create([
                    'student_id' => $authStudent->id,
                    'dialog_id' => $request->input('dialog_id'),
                    'answer_1' => $request->input('dialog.answer.1'),
                    'answer_2' => $request->input('dialog.answer.2'),
                    'answer_3' => $request->input('dialog.answer.3'),
                ]);

                // Store student submitted informal email
                $exam->studentInformalEmails()->create([
                    'student_id' => $authStudent->id,
                    'informal_email_id' => $request->input('informal_email_id'),
                    'subject' => $request->input('informalEmail.subject'),
                    'body' => $request->input('informalEmail.body'),
                ]);

                // Store student submitted formal email
                $exam->studentFormalEmails()->create([
                    'student_id' => $authStudent->id,
                    'formal_email_id' => $request->input('formal_email_id'),
                    'subject' => $request->input('formalEmail.subject'),
                    'body' => $request->input('formalEmail.body'),
                ]);

                // Store student submitted sort question
                foreach ($request->input('sortQuestion.question.*') as $questionId) {
                    $exam->studentSortQuestions()->create([
                        'student_id' => $authStudent->id,
                        'sort_question_id' => $questionId,
                        'answer' => $request->input('sortQuestion.answer.' . $questionId)
                    ]);
                }


                // Generate marks
                $authStudent->marks()->where(['exam_id' => $exam->id, 'set_id' => $authStudent->set->id])->first()->update([
                    'dialog' => 0,
                    'informalEmail' => 0,
                    'formalEmail' => 0,
                    'sortQuestion' => 0
                ]);


                toast('Writing part has been successfully submitted', 'success');
                session()->flash('success_audio');
                return redirect()->route('student.exam.show.topic', $exam->id);

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
