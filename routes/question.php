<?php

use Illuminate\Support\Facades\Route;

/**
 * All Vocabulary routes
 */
// Synonym option route
Route::resource('vocabulary/synonyms/options', 'Teacher\Question\Vocabulary\Synonym\SynonymOptionController', ['as' => 'synonyms']);
// Synonym route
Route::resource('vocabulary/synonyms', 'Teacher\Question\Vocabulary\Synonym\SynonymController');


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
