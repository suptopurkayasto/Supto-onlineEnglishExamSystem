<?php

use Illuminate\Support\Facades\Route;


Route::post('login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
Route::get('login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
Route::get('/', 'Admin\AdminController@index')->name('admin.dashboard');
