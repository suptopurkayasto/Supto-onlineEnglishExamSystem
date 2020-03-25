<?php

namespace App\Http\Controllers\Teacher\Question;

use App\GrammarQuestion;
use App\Http\Controllers\Controller;
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
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\GrammarQuestion  $grammarQuestion
     * @return \Illuminate\Http\Response
     */
    public function show(GrammarQuestion $grammarQuestion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\GrammarQuestion  $grammarQuestion
     * @return \Illuminate\Http\Response
     */
    public function edit(GrammarQuestion $grammarQuestion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\GrammarQuestion  $grammarQuestion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GrammarQuestion $grammarQuestion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\GrammarQuestion  $grammarQuestion
     * @return \Illuminate\Http\Response
     */
    public function destroy(GrammarQuestion $grammarQuestion)
    {
        //
    }
}
