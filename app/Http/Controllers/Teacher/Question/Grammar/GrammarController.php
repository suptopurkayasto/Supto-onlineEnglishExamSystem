<?php

namespace App\Http\Controllers\Teacher\Question\Grammar;

use App\Exam;
use App\Http\Controllers\Controller;
use App\Http\Requests\Teacher\Question\GrammarQuestion\GrammarQuestionUpdateRequest;
use App\Http\Requests\Teacher\Question\GrammarQuestionCreateRequest;
use App\Model\Grammar\Grammar;
use App\QuestionSet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GrammarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('teacher.questions.grammar.index')
            ->with('authTeacher', Auth::guard('teacher')->user());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('teacher.questions.grammar.create')
            ->with('authTeacher', Auth::guard('teacher')->user())
            ->with('questionSets', QuestionSet::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Grammar $grammar
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, Grammar $grammar)
    {

        $questionCount = Auth::guard('teacher')->user()->exams()->find($request->exam_name)->sets()->find($request->question_set)->grammarQuestions()->count();

        if ($questionCount < 25) {
            Grammar::create($this->validateGrammarCreateRequest($request));
            toast('Grammar question has been successfully added', 'success');
            session()->flash('success_audio');
            return redirect()->back();
        } else {
            session()->flash('field_audio');
            alert()->info('Fail!', 'You can no longer add dialog to this ' . QuestionSet::find($request->question_set)->name . ' set.');
            return redirect()->back();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param Grammar $grammar
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Grammar $grammar)
    {
        return view('teacher.questions.grammar.show')
            ->with('grammar', $grammar)
            ->with('questionSets', QuestionSet::all());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Grammar $grammar
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Grammar $grammar)
    {
        return view('teacher.questions.grammar.edit')
            ->with('authTeacher', Auth::guard('teacher')->user())
            ->with('grammar', $grammar)
            ->with('questionSets', QuestionSet::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param GrammarQuestionUpdateRequest $request
     * @param Grammar $grammar
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(GrammarQuestionUpdateRequest $request, Grammar $grammar)
    {
        $questionCount = Auth::guard('teacher')->user()->exams()->find($request->exam_name)->sets()->find($request->question_set)->grammarQuestions()->count();

        if ($questionCount < 25) {
            $grammar->update($this->validateGrammarsUpdateRequest($request));
            toast('Grammar question has been successfully updated', 'success');
            session()->flash('success_audio');
            return redirect()->route('teachers.questions.grammars.show', $grammar->id);
        } else {
            session()->flash('field_audio');
            alert()->info('Fail!', 'You can no longer add dialog to this ' . QuestionSet::find($request->question_set)->name . ' set.');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Grammar $grammar
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Grammar $grammar)
    {
        $grammar->forceDelete();

        toast('Grammar question has been successfully deleted', 'success');
        session()->flash('success_audio');
        return redirect()->route('teachers.questions.grammars.index');
    }

    private function validateGrammarCreateRequest($request)
    {
        $validateData = $this->validate($request, [
            'exam_name' => 'required|max:255|string',
            'question_set' => 'required|max:255|string',
            'question' => 'required|max:255|string',
            'option_1' => 'required|max:255|string',
            'option_2' => 'required|max:255|string',
            'option_3' => 'required|max:255|string',
            'answer' => 'required|max:255|string',
        ]);

        return [
            'exam_id' => $validateData['exam_name'],
            'question_set_id' => $validateData['question_set'],
            'question' => $validateData['question'],
            'option_1' => $validateData['option_1'],
            'option_2' => $validateData['option_2'],
            'option_3' => $validateData['option_3'],
            'answer' => $validateData['answer']
        ];

    }

    private function validateGrammarsUpdateRequest($request)
    {
        $validateData = $this->validate($request, [
            'exam_name' => 'required|max:255|string',
            'question_set' => 'required|max:255|string',
            'question' => 'required|max:255|string',
            'option_1' => 'required|max:255|string',
            'option_2' => 'required|max:255|string',
            'option_3' => 'required|max:255|string',
            'answer' => 'required|max:255|string',
        ]);

        return [
            'exam_id' => $validateData['exam_name'],
            'question_set_id' => $validateData['question_set'],
            'question' => $validateData['question'],
            'option_1' => $validateData['option_1'],
            'option_2' => $validateData['option_2'],
            'option_3' => $validateData['option_3'],
            'answer' => $validateData['answer']
        ];

    }

}
