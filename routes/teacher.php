<?php

use Illuminate\Support\Facades\Route;


/**
 * All Writing part routes
 */
Route::get('questions/writing/create', 'Teacher\Question\Writing\WritingController@create')->name('teachers.writing.create');
Route::get('questions/writing', 'Teacher\Question\Writing\WritingController@index')->name('teachers.writing.index');
// Dialog route
Route::resource('questions/writing/dialogs', 'Teacher\Question\Writing\Dialog\DialogController', ['as' => 'teachers.questions']);









Route::put('exams/{exam}/status', 'Teacher\Exam\ExamController@status')->name('teacher.exams.status');
Route::resource('exams', 'Teacher\Exam\ExamController', ['as' => 'teacher']);

Route::get('students/exams/result', 'Teacher\Student\StudentController@result')->name('teacher.students.exams.result');
Route::resource('students', 'Teacher\Student\StudentController', ['as' => 'teacher']);





Route::post('login', 'Auth\TeacherLoginController@login')->name('teacher.login.submit');
Route::get('login', 'Auth\TeacherLoginController@showLoginForm')->name('teacher.login');
Route::post('logout', 'Auth\TeacherLoginController@teacherLogout')->name('teacher.logout');
Route::get('/', 'Teacher\TeacherController@index')->name('teacher.dashboard');
