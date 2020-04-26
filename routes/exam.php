<?php

use Illuminate\Support\Facades\Route;


// Writing
Route::post('questions/writing', 'Student\ExamController@submitWritingQuestion')->name('student.exam.writing.questions.submit');
Route::get('questions/writing', 'Student\ExamController@showWritingQuestion')->name('student.exam.writing.questions');

// Reading
Route::post('questions/reading', 'Student\ExamController@submitReadingQuestion')->name('student.exam.reading.questions.submit');
Route::get('questions/reading', 'Student\ExamController@showReadingQuestion')->name('student.exam.reading.questions');


// Vocabulary
Route::post('questions/vocabulary/', 'Student\ExamController@submitVocabularyQuestion')->name('student.exam.vocabulary.questions.submit');
Route::get('questions/vocabulary', 'Student\ExamController@showVocabularyQuestion')->name('student.exam.vocabulary.questions');

// Grammar
Route::post('questions/grammar', 'Student\ExamController@submitGrammarQuestion')->name('student.exam.grammar.questions.submit');
Route::get('questions/grammar', 'Student\ExamController@showGrammarQuestion')->name('student.exam.grammar.questions');
Route::get('topic', 'Student\ExamController@showTopic')->name('student.exam.show.topic');
