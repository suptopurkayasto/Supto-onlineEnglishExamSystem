<?php

namespace App\Http\Controllers\Teacher\Question\Grammar;

use App\Exam;
use App\Http\Controllers\Controller;
use App\Http\Requests\Teacher\Question\GrammarQuestion\GrammarQuestionUpdateRequest;
use App\Http\Requests\Teacher\Question\GrammarQuestionCreateRequest;
use App\Model\Grammar\Grammar;
use App\Set;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class GrammarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        return view('teacher.questions.grammar.index')
            ->with('authTeacher', Auth::guard('teacher')->user());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('teacher.questions.grammar.create')
            ->with('authTeacher', Auth::guard('teacher')->user())
            ->with('sets', Set::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param Grammar $grammar
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(Request $request, Grammar $grammar)
    {

        $authTeacher = Auth::guard('teacher')->user();

        $exam = $authTeacher->exams()->find($request->get('exam'));
        $set = $request->input('set');
        $questionCount = $exam->grammars()->where('set_id', $set)->count();

        if ($questionCount < 25) {
            $authTeacher->exams()->find($request->input('exam'))->grammars()->create($this->validateGrammarCreateRequest($request));
            toast('Grammar question has been successfully added', 'success');
            session()->flash('success_audio');
            if ($exam->grammars()->count() >= 100) {
                return redirect()->route('teachers.questions.grammars.index');
            }
            return redirect()->back();
        } else {
            session()->flash('field_audio');
            alert()->info('Fail!', 'You can no longer add grammar question to this ' . Set::find($request->input('set'))->name . ' set.');
            return redirect()->back();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param Grammar $grammar
     * @return Factory|RedirectResponse|View
     */
    public function show(Grammar $grammar)
    {
        if ($this->validGrammarQuestionRequest($grammar)) {
            return view('teacher.questions.grammar.show')
                ->with('grammar', $grammar)
                ->with('sets', Set::all());
        } else {
            alert()->error('😒', 'You can\'t do this.');
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Grammar $grammar
     * @return Factory|RedirectResponse|View
     */
    public function edit(Grammar $grammar)
    {
        if ($this->validGrammarQuestionRequest($grammar)) {
            return view('teacher.questions.grammar.edit')
                ->with('authTeacher', Auth::guard('teacher')->user())
                ->with('grammar', $grammar)
                ->with('sets', Set::all());
        } else {
            alert()->error('😒', 'You can\'t do this.');
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Grammar $grammar
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function update(Request $request, Grammar $grammar)
    {
        if ($this->validGrammarQuestionRequest($grammar)) {

            $authTeacher = Auth::guard('teacher')->user();

            $authTeacherGrammarQuestions = $authTeacher->exams()->find($grammar->exam->id)->grammars()->where(['set_id' => $request->input('set')])->get();

            if ($authTeacherGrammarQuestions->count() < 25 || $grammar->set->id == $request->input('set')) {
                $grammar->update($this->validateGrammarsUpdateRequest($request));
                toast('Grammar question has been successfully updated', 'success');
                session()->flash('success_audio');
                return redirect(route('teachers.questions.grammars.show', $grammar->id).'?exam='.\request()->get('exam'));
            } else {
                session()->flash('field_audio');
                alert()->info('Fail!', 'You can no longer add grammar question to this ' . Set::find($request->input('set'))->name . ' set.');
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
     * @param Grammar $grammar
     * @return RedirectResponse
     */
    public function destroy(Grammar $grammar)
    {
        if ($this->validGrammarQuestionRequest($grammar)) {
            $grammar->forceDelete();

            toast('Grammar question has been successfully deleted', 'success');
            session()->flash('success_audio');
            return redirect()->route('teachers.questions.grammars.index');
        } else {
            alert()->error('😒', 'You can\'t do this.');
            return redirect()->back();
        }
    }

    /**
     * @param $grammar
     * @return bool|null
     */
    private function validGrammarQuestionRequest(Grammar $grammar) {

        $examId = Crypt::decrypt(\request()->get('exam'));

        $authGrammarQuestions = Auth::guard('teacher')->user()->exams()->find($examId)->grammars()->get();

        $valid = null;
        foreach ($authGrammarQuestions as $authGrammarQuestion) {
            if ($authGrammarQuestion->id === $grammar->id) {
                $valid = true;
            }
        }

        return $valid;
    }

    /**
     * @param $request
     * @return array
     * @throws ValidationException
     */
    private function validateGrammarCreateRequest($request)
    {
        $validateData = $this->validate($request, [
            'exam' => 'required|max:255|string',
            'set' => 'required|max:255|string',
            'question' => 'required|max:255|string',
            'option_1' => 'required|max:255|string',
            'option_2' => 'required|max:255|string',
            'option_3' => 'required|max:255|string',
            'answer' => 'required|max:255|string',
        ]);

        return [
            'set_id' => $validateData['set'],
            'question' => $validateData['question'],
            'option_1' => $validateData['option_1'],
            'option_2' => $validateData['option_2'],
            'option_3' => $validateData['option_3'],
            'answer' => $validateData['answer']
        ];

    }

    /**
     * @param $request
     * @return array
     * @throws ValidationException
     */
    private function validateGrammarsUpdateRequest($request)
    {
        $validateData = $this->validate($request, [
            'set' => 'required|integer',
            'question' => 'required|max:255|string',
            'option_1' => 'required|max:255|string',
            'option_2' => 'required|max:255|string',
            'option_3' => 'required|max:255|string',
            'answer' => 'required|max:255|string',
        ]);

        return [
            'set_id' => $validateData['set'],
            'question' => $validateData['question'],
            'option_1' => $validateData['option_1'],
            'option_2' => $validateData['option_2'],
            'option_3' => $validateData['option_3'],
            'answer' => $validateData['answer']
        ];

    }

}
