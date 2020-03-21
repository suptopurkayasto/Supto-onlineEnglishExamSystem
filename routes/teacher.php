<?php

use Illuminate\Support\Facades\Route;

Route::post('login', 'Auth\TeacherLoginController@login')->name('teacher.login.submit');
Route::get('login', 'Auth\TeacherLoginController@showLoginForm')->name('teacher.login');
Route::get('/', 'Teacher\TeacherController@index')->name('teacher.dashboard');
