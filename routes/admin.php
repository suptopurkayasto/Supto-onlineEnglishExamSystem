<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'Admin\AdminController@index')->name('admin.dashboard');
