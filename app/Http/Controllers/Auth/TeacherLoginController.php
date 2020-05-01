<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Teacher;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class TeacherLoginController extends Controller
{

    /**
     * AdminLoginController constructor.
     */
    public function __construct()
    {
        $this->middleware('guest:teacher')->except('teacherLogout');
    }

    /**
     * @return Factory|View
     */
    public function showLoginForm()
    {
        return view('auth.teacher-login');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function login(Request $request)
    {

        // Validate from data
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);
        // Attempt to log user in
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::guard('teacher')->attempt($credentials, $request->remember)) {

            // If successful, then redirect their intended location
            return redirect()->intended(route('teacher.dashboard'));

        } else {

            // If unsuccessful, then redirect to login from with from data
            return redirect()->back()->withInput($request->only('email', 'remember'));

        }
    }

    public function teacherLogout()
    {
        Auth::guard('teacher')->logout();

        return redirect()->route('teacher.login');
    }
}
