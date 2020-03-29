<?php

namespace App\Http\Controllers\Teacher\Question\Writing\SortQuestion;

use App\Http\Controllers\Controller;
use App\Model\Writing\SortQuestion;
use Illuminate\Http\Request;

class SortQuestionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:teacher');
        $this->middleware('teacher.profile');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Model\Writing\SortQuestion  $sortQuestion
     * @return \Illuminate\Http\Response
     */
    public function show(SortQuestion $sortQuestion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Writing\SortQuestion  $sortQuestion
     * @return \Illuminate\Http\Response
     */
    public function edit(SortQuestion $sortQuestion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Writing\SortQuestion  $sortQuestion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SortQuestion $sortQuestion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Writing\SortQuestion  $sortQuestion
     * @return \Illuminate\Http\Response
     */
    public function destroy(SortQuestion $sortQuestion)
    {
        //
    }
}
