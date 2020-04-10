<?php

namespace App\Http\Controllers\Teacher\Question\Vocabulary\Combination;

use App\Http\Controllers\Controller;
use App\Model\Vocabulary\Combination\Combination;
use App\Model\Vocabulary\Combination\CombinationOption;
use App\Set;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\View\View;

class CombinationController extends Controller
{
    private $combinationOption;

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        return view('teacher.questions.vocabulary.combination.index')
            ->with('authTeacher', Auth::guard('teacher')->user());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('teacher.questions.vocabulary.combination.create')
            ->with('sets', Set::all())
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
        $examId = $request->input('exam');
        $setId = $request->input('set');
        $countSynonymWordByExamAndSet = $authTeacher->exams()->find($examId)->combinations()->where('set_id', $setId)->get()->count();

        if ($countSynonymWordByExamAndSet < 5) {

            $combinationOption = CombinationOption::create($this->validateCombinationOptionsCreateRequest($request));
            $this->combinationOption = $combinationOption;

            $authTeacher->exams()->find($examId)->combinations()->create($this->validateCombinationCreateRequest($request));

            session()->flash('success_audio');
            toast('Combination word has been successfully added','success');
        } else {
            session()->flash('field_audio');
            alert()->info('Fail!', 'You can no longer add combination word to this '. Set::find($setId)->name .' set.');
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param Combination $combination
     * @return Factory|RedirectResponse|View
     */
    public function show(Combination $combination)
    {
        if ($this->validCombinationRequest($combination)) {
            return view('teacher.questions.vocabulary.combination.show', compact('combination'))
                ->with('sets', Set::all())
                ->with('authTeacher', Auth::guard('teacher')->user());
        } else {
            alert()->error('😒', 'You can\'t do this.');
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Combination $combination
     * @return Factory|RedirectResponse|View
     */
    public function edit(Combination $combination)
    {
        if ($this->validCombinationRequest($combination)) {
            return view('teacher.questions.vocabulary.combination.edit', compact('combination'))
                ->with('sets', Set::all())
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
     * @param Combination $combination
     * @return RedirectResponse|Redirector
     */
    public function update(Request $request, Combination $combination)
    {
        if ($this->validCombinationRequest($combination)) {

            $authTeacher = Auth::guard('teacher')->user();
            $exam = $authTeacher->exams()->find($request->input('exam'));
            $set = $exam->sets()->find($request->input('set'));

            $countSynonymWordByExamAndSet = $exam->combinations()->where(['set_id' => $set->id])->get()->count();

            if ($countSynonymWordByExamAndSet < 5 || $combination->exam->id == $request->input('exam') && $combination->set->id == $request->input('set')) {
                // Update Definition
                $combination->update($this->validateCombinationUpdateRequest($request));

                // Update Definition Option
                $combination->answer()->update($this->validateCombinationOptionUpdateRequest($request));
                session()->flash('success_audio');
                toast('Definition sentence has been successfully updated','success');
                return redirect(route('teachers.questions.combinations.show', $combination->id).'?exam='.request()->get('exam').'&set='.request()->get('set'));
            } else {
                session()->flash('field_audio');
                alert()->info('Fail!', 'You can no longer add definition sentence to this '. Set::find($set->id)->name .' set.');
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
     * @param Combination $combination
     * @return RedirectResponse
     */
    public function destroy(Combination $combination)
    {
        if ($this->validCombinationRequest($combination)) {
            $combination->answer()->forceDelete();

            $combination->forceDelete();
            session()->flash('success_audio');
            toast('Combination word has been successfully deleted','success');
            return redirect()->route('teachers.questions.combinations.index');
        } else {
            alert()->error('😒', 'You can\'t do this.');
            return redirect()->back();
        }
    }

    private function validateCombinationOptionsCreateRequest(Request $request)
    {
        $validateData = $this->validate($request, [
            'exam' => 'required|integer',
            'set' => 'required|integer',
            'word' => 'required|string|max:255',
            'answer' => 'required|string|max:255',
        ]);

        return [
            'exam_id' => $validateData['exam'],
            'set_id' => $validateData['set'],
            'options' => $validateData['answer']
        ];
    }

    private function validateCombinationCreateRequest(Request $request)
    {
        return [
            'exam_id' => $request->input('exam'),
            'set_id' => $request->input('set'),
            'word' => $request->word,
            'combination_option_id' => $this->combinationOption['id']
        ];
    }

    private function validCombinationRequest(Combination $combination)
    {
        $examId = Crypt::decrypt(\request()->get('exam'));
        $authTeacherCombinationsByExam = Auth::guard('teacher')->user()->exams()->find($examId)->combinations;

        $valid = null;
        foreach ($authTeacherCombinationsByExam as $authTeacherDefinitionByExam) {
            if ($authTeacherDefinitionByExam->id === $combination->id) {
                $valid = true;
            }
        }

        return $valid;
    }





    private function validateCombinationUpdateRequest(Request $request)
    {
        $validateData = $this->validate($request, [
            'exam' => 'required|integer',
            'set' => 'required|integer',
            'word' => 'required|string|max:255',
            'answer' => 'required|string|max:255',
        ]);

        return [
            'exam_id' => $validateData['exam'],
            'set_id' => $validateData['set'],
            'word' => $validateData['word'],
        ];
    }

    private function validateCombinationOptionUpdateRequest(Request $request)
    {
        return [
            'options' => $request->answer,
        ];
    }
}
