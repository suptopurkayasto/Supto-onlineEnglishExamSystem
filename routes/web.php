<?php

use App\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Twilio\Rest\Client;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomePageController@index');


//
Route::get('login', function () {
    return redirect()->route('student.login');
});
Route::get('register', function () {
    return redirect()->route('student.login');
});
Auth::routes();



//
//Route::get('/home', 'HomeController@index')->name('home');

Route::get('test', function () {
    return Auth::guard('teacher')->user()->students;
});
