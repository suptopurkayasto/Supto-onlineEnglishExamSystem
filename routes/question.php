<?php

use Illuminate\Support\Facades\Route;

/**
 * All Writing part routes
 */

// Dialog route
Route::resource('writing/dialogs', 'Teacher\Question\Writing\Dialog\DialogController');

// Informal Email route
Route::resource('writing/informal-email', 'Teacher\Question\Writing\Email\InformalEmailController');


// Formal Email route
Route::resource('writing/formal-email', 'Teacher\Question\Writing\Email\FormalEmailController');


// Sort Question route
Route::resource('writing/sort-questions', 'Teacher\Question\Writing\SortQuestion\SortQuestionController');



/**
 * All Grammars routes
 */
Route::resource('grammars', 'Teacher\Question\Grammar\GrammarController');
