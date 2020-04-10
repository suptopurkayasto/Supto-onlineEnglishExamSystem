<?php

namespace App\Http\Controllers\Teacher\Question\Vocabulary\Synonym;

use App\Http\Controllers\Controller;
use App\Model\Vocabulary\Synonym\SynonymOption;
use App\Set;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\View\View;

class SynonymOptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {

        $authTeacher = Auth::guard('teacher')->user();
        $examId = Crypt::decrypt(\request()->get('exam'));
        $setId = Crypt::decrypt(\request()->get('set'));

        $options = SynonymOption::where(['exam_id' => $examId, 'set_id' => $setId])->get();

        return view('teacher.questions.vocabulary.synonym.options.index', compact('options'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('teacher.questions.vocabulary.synonym.options.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $examId = Crypt::decrypt($request->get('exam'));
        $setId = Crypt::decrypt($request->get('set'));

        $synonymOptionByExamAndSet = SynonymOption::where(['exam_id' => $examId, 'set_id' => $setId])->get()->count();

        if ($synonymOptionByExamAndSet < 10) {

            SynonymOption::create($this->validateSynonymOptionsCreateRequest($request));
            session()->flash('success_audio');
            toast('Option has been successfully created','success');
            return redirect()->back();
        } else {
            session()->flash('field_audio');
            alert()->info('Fail!', 'You can no longer add Option to this '. Set::find($setId)->name .' set.');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param SynonymOption $option
     * @return Factory|RedirectResponse|View
     */
    public function show(SynonymOption $option)
    {
        if ($this->validOptionRequest($option)) {
           return view('teacher.questions.vocabulary.synonym.options.show', compact('option'));
        } else {
            alert()->error('😒', 'You can\'t do this.');
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param SynonymOption $option
     * @return Factory|RedirectResponse|View
     */
    public function edit(SynonymOption $option)
    {
        if ($this->validOptionRequest($option)) {
            return view('teacher.questions.vocabulary.synonym.options.edit', compact('option'));
        } else {
            alert()->error('😒', 'You can\'t do this.');
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param SynonymOption $option
     * @return RedirectResponse|Redirector
     */
    public function update(Request $request, SynonymOption $option)
    {
        if ($this->validOptionRequest($option)) {
            $option->update($this->validateSynonymOptionsUpdateRequest($request));
            session()->flash('success_audio');
            toast('Synonym Word has been successfully updated','success');
            return redirect(route('teachers.questions.synonyms.options.show', $option->id).'?exam='.\request()->get('exam').'&set='.\request()->get('set'));
        } else {
            alert()->error('😒', 'You can\'t do this.');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param SynonymOption $option
     * @return RedirectResponse
     */
    public function destroy(SynonymOption $option)
    {
        if ($this->validOptionRequest($option)) {
            $option->forceDelete();
            session()->flash('success_audio');
            toast('Option has been successfully deleted','success');
            return redirect(route('teachers.questions.synonyms.options.index').'?exam='.\request()->get('exam').'&set='. \request()->get('set'));
        } else {
            alert()->error('😒', 'You can\'t do this.');
            return redirect()->back();
        }
    }

    private function validateSynonymOptionsCreateRequest($request)
    {
        $validateData = $this->validate($request, [
            'option' => 'required|string|max:255',
        ]);

        return [
            'exam_id' => Crypt::decrypt($request->get('exam')),
            'set_id' => Crypt::decrypt($request->get('set')),
            'options' => $validateData['option']
        ];

    }
    private function validateSynonymOptionsUpdateRequest($request)
    {
        $validateData = $this->validate($request, [
            'option' => 'required|string|max:255',
        ]);

        return [
            'options' => $validateData['option']
        ];

    }

    private function validOptionRequest($option) {
        $examId = Crypt::decrypt(\request()->get('exam'));
        $setId = Crypt::decrypt(\request()->get('set'));
        $authTeacherOptionByExamAndSet = Auth::guard('teacher')->user()->exams()->find($examId)->synonymOptions()->where('set_id', $setId)->get();

        $valid = null;
        foreach ($authTeacherOptionByExamAndSet as $item) {
            if ($item->id === $option->id) {
                $valid = true;
            }
        }

        return $valid;
    }

}
