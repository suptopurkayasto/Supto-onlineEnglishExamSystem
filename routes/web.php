<?php

use App\Exam;
use App\Student;
use Carbon\Carbon;
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
    $authStudent = Auth::guard('student')->user();

    $exam = Exam::find(1);
    $re = $exam->rearranges()->where('set_id', 4)->get()->first();
    $res = $authStudent->studentRearranges()->where(['exam_id' => 1, 'set_id' => 4])->get()->first();

    $marks = 0;
    for ($n = 1; $n <= 7; $n++) {
        if ($re["line_$n"] == $res["line_$n"]) {
            $marks += 1;
        }
    }

    return $marks;

});
