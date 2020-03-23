<?php

use Illuminate\Support\Facades\Route;


Route::resource('exams', 'Teacher\Exam\ExamController', ['as' => 'teacher']);
Route::resource('students', 'Teacher\Student\StudentController', ['as' => 'teacher']);

Route::post('login', 'Auth\TeacherLoginController@login')->name('teacher.login.submit');
Route::get('login', 'Auth\TeacherLoginController@showLoginForm')->name('teacher.login');
Route::post('logout', 'Auth\TeacherLoginController@teacherLogout')->name('teacher.logout');
Route::get('/', 'Teacher\TeacherController@index')->name('teacher.dashboard');
