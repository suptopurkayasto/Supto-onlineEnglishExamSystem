<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:student');
    }
    public function index()
    {
        return view('pages.home');
    }
}
