<?php

namespace App\Http\Controllers\Teacher\Question\Vocabulary\Synonym;

use App\Http\Controllers\Controller;
use App\Model\Vocabulary\Synonym;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SynonymController extends Controller
{
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
     * @param  \App\Model\Vocabulary\Synonym  $synonym
     * @return \Illuminate\Http\Response
     */
    public function show(Synonym $synonym)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Vocabulary\Synonym  $synonym
     * @return \Illuminate\Http\Response
     */
    public function edit(Synonym $synonym)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Vocabulary\Synonym  $synonym
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Synonym $synonym)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Vocabulary\Synonym  $synonym
     * @return \Illuminate\Http\Response
     */
    public function destroy(Synonym $synonym)
    {
        //
    }
}
