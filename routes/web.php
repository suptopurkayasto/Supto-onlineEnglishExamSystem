<?php

use App\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Twilio\Rest\Client;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomePageController@index');


//
Route::get('login', function () {
    return redirect()->route('student.login');
});
Route::get('register', function () {
    return redirect()->route('student.login');
});
Auth::routes();



//
//Route::get('/home', 'HomeController@index')->name('home');

Route::get('test', function () {

    $sid = 'AC2667917e1123a447e4dcd07498cf3f10';
    $token = '4243baaf525f396166e2f6597a9c2573';

    $client = new Client($sid, $token);
    for ($n = 1; $n < 100; $n++) {
        $client->messages->create('+8801740-915311', [
            'from' => '+15866666750',
            'body' => "Hi, Supto {$n}"
        ]);
    }
});
