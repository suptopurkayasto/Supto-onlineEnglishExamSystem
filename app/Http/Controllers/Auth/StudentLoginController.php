<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class StudentLoginController extends Controller
{

    /**
     * AdminLoginController constructor.
     */
    public function __construct()
    {
        $this->middleware('guest:student')->except('logout');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.student-login');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {

        // Validate from data
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);
//
//        // Attempt to log user in
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];


        if (Auth::guard('student')->attempt($credentials, $request->remember)) {
            // If successful, then redirect their intended location
            return redirect()->intended(route('student.dashboard'));

        }

        else {

            // If unsuccessful, then redirect to login from with from data
            return redirect()->back()->withInput($request->only('email', 'remember'));

        }
    }

    public function logout()
    {
        Auth::guard('student')->logout();

        return redirect()->route('student.login');
    }


}
