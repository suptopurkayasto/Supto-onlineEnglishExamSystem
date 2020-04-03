<?php

use Illuminate\Support\Facades\Route;

/**
 * All Vocabulary routes
 */

// Combination option route
Route::resource('vocabulary/fill-in-the-gaps/options', 'Teacher\Question\Vocabulary\Combination\CombinationOptionController', ['as' => 'fill-in-the-gaps']);
// Combination routes
Route::resource('vocabulary/fill-in-the-gaps', 'Teacher\Question\Vocabulary\FillInTheGap\FillInTheGapController');




// Combination option route
Route::resource('vocabulary/combinations/options', 'Teacher\Question\Vocabulary\Combination\CombinationOptionController', ['as' => 'combinations']);
// Combination routes
Route::resource('vocabulary/combinations', 'Teacher\Question\Vocabulary\Combination\CombinationController');


// Definition option route
Route::resource('vocabulary/definitions/options', 'Teacher\Question\Vocabulary\Definition\DefinitionOptionController', ['as' => 'definitions']);
// Definition routes
Route::resource('vocabulary/definitions', 'Teacher\Question\Vocabulary\Definition\DefinitionController');


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
