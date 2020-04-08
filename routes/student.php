<?php

use Illuminate\Support\Facades\Route;


Route::get('login', 'Auth\StudentLoginController@showLoginForm')->name('student.login');
Route::post('login', 'Auth\StudentLoginController@login')->name('student.login.submit');
Route::post('logout', 'Auth\StudentLoginController@logout')->name('student.logout');
Route::get('/', 'Student\StudentController@index')->name('student.dashboard');
