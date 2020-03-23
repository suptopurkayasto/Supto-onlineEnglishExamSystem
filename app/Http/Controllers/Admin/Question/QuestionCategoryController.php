<?php

namespace App\Http\Controllers\Admin\Question;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Question_Category\QuestionCategoryCreateRequest;
use App\QuestionCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class QuestionCategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.question_categories.index')
            ->with('questionCategories', QuestionCategory::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.question_categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(QuestionCategoryCreateRequest $request)
    {
        $question_categories = new QuestionCategory();
        $data = $request->only('name');
        $data['slug'] = Str::slug($request->name);

        $question_categories->create($data);

        toast('Question Category was created successfully!','success');
        session()->flash('success_audio');
        return redirect()->route('admin.question-categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\QuestionCategory  $questionCategory
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(QuestionCategory $questionCategory)
    {
        return view('admin.question_categories.show', compact('questionCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\QuestionCategory  $questionCategory
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(QuestionCategory $questionCategory)
    {
        return view('admin.question_categories.edit', compact('questionCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\QuestionCategory  $questionCategory
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, QuestionCategory $questionCategory)
    {
        $questionCategory->update($this->validateUpdateQuestionCategoryRequest($request));
        toast('Question Category was updated successfully!','success');
        session()->flash('success_audio');
        return redirect()->route('admin.question-categories.show', $questionCategory->slug);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\QuestionCategory  $questionCategory
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(QuestionCategory $questionCategory)
    {
        $questionCategory->forceDelete();
        toast('Question category was deleted successfully!','success');
        session()->flash('success_audio');
        return redirect()->route('admin.question-categories.index');
    }

    protected function validateUpdateQuestionCategoryRequest($request) {
        return $this->validate($request, [
            'name' => 'required|max:255|string|unique:question_categories',
        ]);
    }

}
