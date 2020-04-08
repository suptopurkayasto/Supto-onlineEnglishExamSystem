<?php

use Illuminate\Support\Facades\Route;

Route::get('topic', 'Student\ExamController@showTopic')->name('student.exam.show.topic');
