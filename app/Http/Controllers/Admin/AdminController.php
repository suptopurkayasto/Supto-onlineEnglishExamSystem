<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('web');
        $this->middleware('auth:admin');
    }
    public function index()
    {
        return view('admin.dashboard')
            ->with('admin', Auth::guard('admin')->user());
    }
}
