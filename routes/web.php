<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    $gq = \App\Exam::find(1)->studentGrammars()->where(['student_id' => 1, 'grammar_id' => 100])->get()->first();

if (!empty($gq)) {
    $grammarAnswer = $gq->answer;
}
return isset($grammarAnswer) ? 'set' : 'not-answer';
});
