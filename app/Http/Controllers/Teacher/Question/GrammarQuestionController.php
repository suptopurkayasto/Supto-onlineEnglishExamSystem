<?php

namespace App\Http\Controllers\Teacher\Question;

use App\Exam;
use App\GrammarQuestion;
use App\Http\Controllers\Controller;
use App\Http\Requests\Teacher\Question\GrammarQuestion\GrammarQuestionUpdateRequest;
use App\Http\Requests\Teacher\Question\GrammarQuestionCreateRequest;
use App\QuestionSet;
use Illuminate\Http\Request;

class GrammarQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('teacher.grammar-questions.index')
            ->with('grammarQuestions', GrammarQuestion::latest()->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('teacher.grammar-questions.create')
            ->with('exams', Exam::latest()->get())
            ->with('questionSets', QuestionSet::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(GrammarQuestionCreateRequest $request)
    {
        $questionCount = 1;
        $questionSets = Exam::find($request->exam_name)->sets;

        foreach ($questionSets as $questionSet) {
            if ($questionSet->id == $request->question_set) {
                 $questionCount += QuestionSet::find($request->question_set)->grammarQuestions()->count();
            }
        }

        if ($questionCount <= 25) {
            $data = $request->except('exam_name', 'question_set');
            $data['exam_id'] = $request->exam_name;
            $data['question_set_id'] = $request->question_set;

            GrammarQuestion::create($data);
            toast('Grammar question has been successfully added','success');
            session()->flash('success_audio');
            return redirect()->back();
        }
        toast('You can no longer add questions to this grammar category','warning');
        session()->flash('success_audio');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\GrammarQuestion  $grammarQuestion
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(GrammarQuestion $grammarQuestion)
    {
        return view('teacher.grammar-questions.show')
            ->with('grammarQuestion', $grammarQuestion)
            ->with('exams', Exam::latest()->get())
            ->with('questionSets', QuestionSet::all());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\GrammarQuestion  $grammarQuestion
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(GrammarQuestion $grammarQuestion)
    {
        return view('teacher.grammar-questions.edit')
            ->with('grammarQuestion', $grammarQuestion)
            ->with('exams', Exam::latest()->get())
            ->with('questionSets', QuestionSet::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\GrammarQuestion  $grammarQuestion
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(GrammarQuestionUpdateRequest $request, GrammarQuestion $grammarQuestion)
    {
        $data = $request->except('exam_name', 'question_set');
        $data['exam_id'] = $request->exam_name;
        $data['question_set_id'] = $request->question_set;

        $grammarQuestion->update($data);
        toast('Grammar question has been successfully updated','success');
        session()->flash('success_audio');
        return redirect()->route('teachers.grammar-questions.show', $grammarQuestion->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\GrammarQuestion  $grammarQuestion
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(GrammarQuestion $grammarQuestion)
    {
        $grammarQuestion->forceDelete();

        toast('Grammar question has been successfully deleted','success');
        session()->flash('success_audio');
        return redirect()->route('teachers.grammar-questions.index');
    }
}
