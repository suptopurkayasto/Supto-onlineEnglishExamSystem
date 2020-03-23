<?php

use Illuminate\Support\Facades\Route;



Route::delete('locations/trash/delete/{slug}', 'Admin\Location\LocationController@trashDelete')->name('admin.location.trash.delete');
Route::patch('locations/trash/restore{slug}', 'Admin\Location\LocationController@restore')->name('admin.location.trash.restore');
Route::get('locations/trash', 'Admin\Location\LocationController@trash')->name('admin.location.trash');
Route::resource('locations', 'Admin\Location\LocationController',[ 'as' => 'admin']);

Route::patch('teachers/{teacher}/status', 'Admin\Teacher\TeacherController@status')->name('admin.teachers.status');
Route::resource('teachers', 'Admin\Teacher\TeacherController',[ 'as' => 'admin']);

Route::resource('students', 'Admin\Student\StudentController',[ 'as' => 'admin']);

Route::post('login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
Route::get('login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
Route::post('logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
Route::get('/', 'Admin\AdminController@index')->name('admin.dashboard');
