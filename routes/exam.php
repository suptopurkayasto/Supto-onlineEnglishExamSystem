<?php

use Illuminate\Support\Facades\Route;

Route::post('questions/grammar', 'Student\ExamController@submitGrammarQuestion')->name('student.exam.grammar.questions.submit');
Route::get('questions/grammar', 'Student\ExamController@showGrammarQuestion')->name('student.exam.grammar.questions');
Route::get('topic', 'Student\ExamController@showTopic')->name('student.exam.show.topic');
