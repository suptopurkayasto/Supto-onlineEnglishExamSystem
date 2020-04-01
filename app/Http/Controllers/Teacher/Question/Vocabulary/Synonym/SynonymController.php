<?php

namespace App\Http\Controllers\Teacher\Question\Vocabulary\Synonym;

use App\Http\Controllers\Controller;
use App\Model\Vocabulary\Synonym\Synonym;
use App\Model\Vocabulary\Synonym\SynonymOption;
use App\QuestionSet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SynonymController extends Controller
{
    protected $synonymOptions;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('teacher.questions.vocabulary.synonym.index')
            ->with('authTeacher', Auth::guard('teacher')->user());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $exam = $request->exam;
        $set = $request->questionSet;

        $countSynonymWordByExamAndSet = Synonym::where(['exam_id' => $exam, 'question_set_id' => $set])->get()->count();

        if ($countSynonymWordByExamAndSet < 5) {

            $synonymOptions = SynonymOption::create($this->validateSynonymOptionsCreateRequest($request));
            $this->synonymOptions = $synonymOptions;

            Synonym::create($this->validateSynonymCreateRequest($request));

            session()->flash('success_audio');
            toast('Synonym word has been successfully added','success');
        } else {
            session()->flash('field_audio');
            alert()->info('Fail!', 'You can no longer add synonym word to this '. QuestionSet::find($set)->name .' set.');
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param Synonym $synonym
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Synonym $synonym)
    {
        return view('teacher.questions.vocabulary.synonym.show', compact('synonym'))
            ->with('questionSets', QuestionSet::all())
            ->with('authTeacher', Auth::guard('teacher')->user());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Synonym $synonym
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Synonym $synonym)
    {
        return view('teacher.questions.vocabulary.synonym.edit', compact('synonym'))
            ->with('questionSets', QuestionSet::all())
            ->with('authTeacher', Auth::guard('teacher')->user());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Synonym $synonym
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Synonym $synonym)
    {
        $authTeacher = Auth::guard('teacher')->user();
        $exam = $authTeacher->exams()->find($request->exam);
        $set = $exam->sets()->find($request->questionSet);

        if ($synonym->exam->id == $exam->id && $synonym->set->id == $set->id) {
            $synonym->update($this->validateSynonymUpdateRequest($request));
            session()->flash('success_audio');
            toast('Synonym Word has been successfully updated','success');
            return redirect()->route('teachers.questions.synonyms.show', $synonym->id);
        }

        $countSynonymWordByExamAndSet = Synonym::where(['exam_id' => $exam->id, 'question_set_id' => $set->id])->get()->count();

        if ($countSynonymWordByExamAndSet < 5) {
            $synonym->update($this->validateSynonymUpdateRequest($request));
            session()->flash('success_audio');
            toast('Synonym Word has been successfully updated','success');
            return redirect()->route('teachers.questions.synonyms.show', $synonym->id);
        } else {
            session()->flash('field_audio');
            alert()->info('Fail!', 'You can no longer add synonym word to this '. QuestionSet::find($set->id)->name .' set.');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Synonym $synonym
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Synonym $synonym)
    {
        $synonym->forceDelete();
        session()->flash('success_audio');
        toast('Synonym word has been successfully deleted','success');
        return redirect()->route('teachers.questions.synonyms.index');
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

    private function validateSynonymCreateRequest($request)
    {
        $validateData = $this->validate($request, [
            'exam' => 'required|integer',
            'questionSet' => 'required|integer',
            'word' => 'required|string|max:255',
            'answer' => 'required|string|max:255',
        ]);

        return [
            'exam_id' => $validateData['exam'],
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
