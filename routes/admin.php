<?php

use Illuminate\Support\Facades\Route;

Route::resource('locations', 'Admin\Location\LocationController',[ 'as' => 'admin']);

Route::patch('teachers/{teacher}/status', 'Admin\Teacher\TeacherController@status')->name('admin.teachers.status');
Route::resource('teachers', 'Admin\Teacher\TeacherController',[ 'as' => 'admin']);

Route::resource('students', 'Admin\Student\StudentController',[ 'as' => 'admin'])->only('index', 'show');

Route::post('login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
Route::get('login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
Route::post('logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
Route::get('/', 'Admin\AdminController@index')->name('admin.dashboard');
