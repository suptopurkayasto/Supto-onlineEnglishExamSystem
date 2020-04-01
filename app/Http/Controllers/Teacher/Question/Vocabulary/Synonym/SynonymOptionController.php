<?php

namespace App\Http\Controllers\Teacher\Question\Vocabulary\Synonym;

use App\Http\Controllers\Controller;
use App\Model\Vocabulary\Synonym\SynonymOption;
use App\QuestionSet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class SynonymOptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {

        $authTeacher = Auth::guard('teacher')->user();
        $exam_id = (int)Crypt::decryptString(\request()->get('exam'));
        $question_set_id = (int)Crypt::decryptString(\request()->get('set'));

        $synonymOptions = $authTeacher->exams()->find($exam_id)->sets()->find($question_set_id)->synonymOptions;

        return view('teacher.questions.vocabulary.synonym.options.index', compact('synonymOptions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('teacher.questions.vocabulary.synonym.options.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $authTeacher = Auth::guard('teacher')->user();
        $examId = (int)Crypt::decryptString($request->exam_id);
        $questionSetId = (int)Crypt::decryptString($request->question_set_id);
        $authTeacherSynonymOptionCountByExamAndId = $authTeacher->exams()->find($examId)->sets()->find($questionSetId)->synonymOptions()->count();
        if ($authTeacherSynonymOptionCountByExamAndId < 10) {
            SynonymOption::create($this->validateSynonymOptionsCreateRequest($request));
            session()->flash('success_audio');
            toast('Option has been successfully created','success');
            return redirect()->back();
        } else {
            session()->flash('field_audio');
            alert()->info('Fail!', 'You can no longer add Option to this '. QuestionSet::find($questionSetId)->name .' set.');
            return redirect()->back();
        }

//        return $this->validateSynonymOptionsCreateRequest($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Vocabulary\Synonym\SynonymOption  $synonymOption
     * @return \Illuminate\Http\Response
     */
    public function show(SynonymOption $synonymOption)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Vocabulary\Synonym\SynonymOption  $synonymOption
     * @return \Illuminate\Http\Response
     */
    public function edit(SynonymOption $synonymOption)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Vocabulary\Synonym\SynonymOption  $synonymOption
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SynonymOption $synonymOption)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Vocabulary\Synonym\SynonymOption  $synonymOption
     * @return \Illuminate\Http\Response
     */
    public function destroy(SynonymOption $synonymOption)
    {
        //
    }

    private function validateSynonymOptionsCreateRequest($request)
    {
        $validateData = $this->validate($request, [
            'exam_id' => 'required',
            'question_set_id' => 'required',
            'option' => 'required|string|max:255',
        ]);

        return [
            'exam_id' => (int)Crypt::decryptString($validateData['exam_id']),
            'question_set_id' => (int)Crypt::decryptString($validateData['question_set_id']),
            'options' => $validateData['option']
        ];

    }

}
