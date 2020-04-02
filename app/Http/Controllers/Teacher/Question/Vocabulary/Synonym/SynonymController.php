<?php

namespace App\Http\Controllers\Teacher\Question\Vocabulary\Synonym;

use App\Http\Controllers\Controller;
use App\Model\Vocabulary\Synonym\Synonym;
use App\Model\Vocabulary\Synonym\SynonymOption;
use App\QuestionSet;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\View\View;

class SynonymController extends Controller
{
    protected $synonymOptions;

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        return view('teacher.questions.vocabulary.synonym.index')
            ->with('authTeacher', Auth::guard('teacher')->user());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('teacher.questions.vocabulary.synonym.create')
            ->with('questionSets', QuestionSet::all())
            ->with('authTeacher', Auth::guard('teacher')->user());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $authTeacher = Auth::guard('teacher')->user();
        $examId = $request->exam;
        $setId = $request->questionSet;
        $countSynonymWordByExamAndSet = $authTeacher->exams()->find($examId)->synonyms()->where('question_set_id', $setId)->get()->count();

        if ($countSynonymWordByExamAndSet < 5) {

            $synonymOptions = SynonymOption::create($this->validateSynonymOptionsCreateRequest($request));
            $this->synonymOptions = $synonymOptions;

            $authTeacher->exams()->find($examId)->synonyms()->create($this->validateSynonymCreateRequest($request));

            session()->flash('success_audio');
            toast('Synonym word has been successfully added','success');
        } else {
            session()->flash('field_audio');
            alert()->info('Fail!', 'You can no longer add synonym word to this '. QuestionSet::find($setId)->name .' set.');
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param Synonym $synonym
     * @return Factory|RedirectResponse|View
     */
    public function show(Synonym $synonym)
    {
        if ($this->validSynonymRequest($synonym)) {
            return view('teacher.questions.vocabulary.synonym.show', compact('synonym'))
                ->with('questionSets', QuestionSet::all())
                ->with('authTeacher', Auth::guard('teacher')->user());
        } else {
            alert()->error('😒', 'You can\'t do this.');
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Synonym $synonym
     * @return Factory|RedirectResponse|View
     */
    public function edit(Synonym $synonym)
    {
        if ($this->validSynonymRequest($synonym)) {
            return view('teacher.questions.vocabulary.synonym.edit', compact('synonym'))
                ->with('questionSets', QuestionSet::all())
                ->with('authTeacher', Auth::guard('teacher')->user());
        } else {
            alert()->error('😒', 'You can\'t do this.');
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Synonym $synonym
     * @return RedirectResponse
     */
    public function update(Request $request, Synonym $synonym)
    {
        if ($this->validSynonymRequest($synonym)) {
            $authTeacher = Auth::guard('teacher')->user();
            $exam = $authTeacher->exams()->find($request->exam);
            $set = $exam->sets()->find($request->questionSet);

            if ($synonym->exam->id == $exam->id && $synonym->set->id == $set->id) {
                $synonym->update($this->validateSynonymUpdateRequest($request));
                session()->flash('success_audio');
                toast('Synonym Word has been successfully updated','success');
                return redirect(route('teachers.questions.synonyms.show', $synonym->id).'?exam='.request()->get('exam').'&set='.request()->get('set'));
            }

            $countSynonymWordByExamAndSet = Synonym::where(['exam_id' => $exam->id, 'question_set_id' => $set->id])->get()->count();

            if ($countSynonymWordByExamAndSet < 5) {
                $synonym->update($this->validateSynonymUpdateRequest($request));
                session()->flash('success_audio');
                toast('Synonym Word has been successfully updated','success');
                return redirect(route('teachers.questions.synonyms.show', $synonym->id).'?exam='.request()->get('exam').'&set='.request()->get('set'));
            } else {
                session()->flash('field_audio');
                alert()->info('Fail!', 'You can no longer add synonym word to this '. QuestionSet::find($set->id)->name .' set.');
                return redirect()->back();
            }
        } else {
            alert()->error('😒', 'You can\'t do this.');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Synonym $synonym
     * @return RedirectResponse
     */
    public function destroy(Synonym $synonym)
    {
        if ($this->validSynonymRequest($synonym)) {
            $synonym->answer()->forceDelete();

            $synonym->forceDelete();
            session()->flash('success_audio');
            toast('Synonym word has been successfully deleted','success');
            return redirect()->route('teachers.questions.synonyms.index');
        } else {
            alert()->error('😒', 'You can\'t do this.');
            return redirect()->back();
        }
    }

    private function validateSynonymOptionsCreateRequest($request)
    {
        $validateData = $this->validate($request, [
            'exam' => 'required|integer',
            'questionSet' => 'required|integer',
            'answer' => 'required|string|max:255',
        ]);

        return [
            'exam_id' => $validateData['exam'],
            'question_set_id' => $validateData['questionSet'],
            'options' => $validateData['answer']
        ];

    }

    private function validSynonymRequest($synonym) {

        $examId = Crypt::decrypt(\request()->get('exam'));
        $authTeacherOptionByExam = Auth::guard('teacher')->user()->exams()->find($examId)->synonyms;

        $valid = null;
        foreach ($authTeacherOptionByExam as $item) {
            if ($item->id === $synonym->id) {
                $valid = true;
            }
        }

        return $valid;
    }

    private function validateSynonymCreateRequest($request)
    {
        $validateData = $this->validate($request, [
            'questionSet' => 'required|integer',
            'word' => 'required|string|max:255',
            'answer' => 'required|string|max:255',
        ]);

        return [
            'question_set_id' => $validateData['questionSet'],
            'synonym_option_id' => $this->synonymOptions['id'],
            'word' => $validateData['word'],
        ];

    }

    private function validateSynonymUpdateRequest($request)
    {
        $validateData = $this->validate($request, [
            'exam' => 'required|integer',
            'questionSet' => 'required|integer',
            'word' => 'required|string|max:255',
        ]);

        return [
            'exam_id' => $validateData['exam'],
            'question_set_id' => $validateData['questionSet'],
            'word' => $validateData['word'],
        ];

    }


}
