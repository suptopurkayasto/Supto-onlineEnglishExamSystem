<?php

use Illuminate\Support\Facades\Route;



Route::put('exams/{exam}/status', 'Teacher\Exam\ExamController@status')->name('teacher.exams.status');
Route::resource('exams', 'Teacher\Exam\ExamController', ['as' => 'teacher']);

// Writing Marks
Route::patch('students/exams/answer-sheets/{exam}/{student}/sortQuestion', 'Teacher\Exam\AnswerSheetController@sortQuestionMarksSubmit')->name('teacher.students.exams.answer-sheets.sortQuestion.marks.submit');
Route::patch('students/exams/answer-sheets/{exam}/{student}/formalEmail', 'Teacher\Exam\AnswerSheetController@formalEmailMarksSubmit')->name('teacher.students.exams.answer-sheets.formalEmail.marks.submit');
Route::patch('students/exams/answer-sheets/{exam}/{student}/informalEmail', 'Teacher\Exam\AnswerSheetController@informalEmailMarksSubmit')->name('teacher.students.exams.answer-sheets.informalEmail.marks.submit');
Route::patch('students/exams/answer-sheets/{exam}/{student}/dialog', 'Teacher\Exam\AnswerSheetController@dialogMarksSubmit')->name('teacher.students.exams.answer-sheets.dialog.marks.submit');

Route::get('students/exams/answer-sheets/{exam}/{student}/show', 'Teacher\Exam\AnswerSheetController@show')->name('teacher.students.exams.answer-sheets.show');
Route::get('students/exams/answer-sheets', 'Teacher\Exam\AnswerSheetController@index')->name('teacher.students.exams.answer-sheets');


Route::resource('students', 'Teacher\Student\StudentController', ['as' => 'teacher']);





Route::post('login', 'Auth\TeacherLoginController@login')->name('teacher.login.submit');
Route::get('login', 'Auth\TeacherLoginController@showLoginForm')->name('teacher.login');
Route::post('logout', 'Auth\TeacherLoginController@teacherLogout')->name('teacher.logout');
Route::get('/', 'Teacher\TeacherController@index')->name('teacher.dashboard');
