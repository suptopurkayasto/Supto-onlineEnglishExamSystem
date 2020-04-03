<?php

namespace App\Http\Controllers\Teacher\Question\Vocabulary\Definition;

use App\Http\Controllers\Controller;
use App\Model\Vocabulary\Definition\Definition;
use App\Model\Vocabulary\Definition\DefinitionOption;
use App\QuestionSet;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\View\View;

class DefinitionController extends Controller
{
    private $definitionOptions;

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        return view('teacher.questions.vocabulary.definition.index')
            ->with('authTeacher', Auth::guard('teacher')->user());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('teacher.questions.vocabulary.definition.create')
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
        $countSynonymWordByExamAndSet = $authTeacher->exams()->find($examId)->definitions()->where('question_set_id', $setId)->get()->count();

        if ($countSynonymWordByExamAndSet < 5) {

            $definitionOptions = DefinitionOption::create($this->validateDefinitionOptionsCreateRequest($request));
            $this->definitionOptions = $definitionOptions;

            $authTeacher->exams()->find($examId)->definitions()->create($this->validateDefinitionCreateRequest($request));

            session()->flash('success_audio');
            toast('Definition sentence has been successfully added','success');
        } else {
            session()->flash('field_audio');
            alert()->info('Fail!', 'You can no longer add synonym word to this '. QuestionSet::find($setId)->name .' set.');
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param Definition $definition
     * @return Factory|RedirectResponse|View
     */
    public function show(Definition $definition)
    {
        if ($this->validDefinitionRequest($definition)) {
            return view('teacher.questions.vocabulary.definition.show', compact('definition'))
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
     * @param Definition $definition
     * @return Factory|RedirectResponse|View
     */
    public function edit(Definition $definition)
    {

        if ($this->validDefinitionRequest($definition)) {
            return view('teacher.questions.vocabulary.definition.edit', compact('definition'))
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
     * @param Definition $definition
     * @return RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Definition $definition)
    {
        if ($this->validDefinitionRequest($definition)) {

            $authTeacher = Auth::guard('teacher')->user();
            $exam = $authTeacher->exams()->find($request->exam);
            $set = $exam->sets()->find($request->questionSet);

            $oldDefinition = Definition::find($definition->id);


            $countSynonymWordByExamAndSet = $exam->definitions()->where(['question_set_id' => $set->id])->get()->count();

            if ($countSynonymWordByExamAndSet < 5 || $oldDefinition->exam->id == $definition->id || $oldDefinition->set->id == $definition->questionSet) {
                $definition->update($this->validateDefinitionUpdateRequest($request));
                session()->flash('success_audio');
                toast('Definition sentence has been successfully updated','success');
                return redirect(route('teachers.questions.definitions.show', $definition->id).'?exam='.request()->get('exam').'&set='.request()->get('set'));
            } else {
                session()->flash('field_audio');
                alert()->info('Fail!', 'You can no longer add definition sentence to this '. QuestionSet::find($set->id)->name .' set.');
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
     * @param Definition $definition
     * @return RedirectResponse
     */
    public function destroy(Definition $definition)
    {
        if ($this->validDefinitionRequest($definition)) {
            $definition->answer()->forceDelete();

            $definition->forceDelete();
            session()->flash('success_audio');
            toast('Definition sentence has been successfully deleted','success');
            return redirect()->route('teachers.questions.definitions.index');
        } else {
            alert()->error('😒', 'You can\'t do this.');
            return redirect()->back();
        }
    }

    private function validDefinitionRequest($definition) {

        $examId = Crypt::decrypt(\request()->get('exam'));
        $authTeacherDefinitionsByExam = Auth::guard('teacher')->user()->exams()->find($examId)->definitions;

        $valid = null;
        foreach ($authTeacherDefinitionsByExam as $authTeacherDefinitionByExam) {
            if ($authTeacherDefinitionByExam->id === $definition->id) {
                $valid = true;
            }
        }

        return $valid;
    }


    private function validateDefinitionCreateRequest(Request $request)
    {
        return [
            'question_set_id' => $request->questionSet,
            'definition_option_id' => $this->definitionOptions['id'],
            'sentence' => $request->sentence,
        ];
    }

    private function validateDefinitionOptionsCreateRequest(Request $request)
    {
        $validateData = $this->validate($request, [
            'exam' => 'required|integer',
            'questionSet' => 'required|integer',
            'sentence' => 'required|string|max:255',
            'answer' => 'required|string|max:255',
        ]);

        return [
            'exam_id' => $validateData['exam'],
            'question_set_id' => $validateData['questionSet'],
            'options' => $validateData['answer']
        ];
    }

    private function validateDefinitionUpdateRequest(Request $request)
    {
        $validateData = $this->validate($request, [
            'exam' => 'required|integer',
            'questionSet' => 'required|integer',
            'sentence' => 'required|string|max:255',
        ]);

        return [
            'exam_id' => $validateData['exam'],
            'question_set_id' => $validateData['questionSet'],
            'sentence' => $validateData['sentence'],
        ];
    }
}
