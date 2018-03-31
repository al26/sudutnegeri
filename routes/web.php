<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::namespace('Auth')->group(function () {
    Route::get('/logout', 'LoginController@logout')->name('logout');
});
Route::get('/home', 'HomeController@index')->name('home');
<<<<<<< HEAD

Route::group(['prefix' => 'admin'], function () {
    Route::get('/login', 'AdminController@showLoginForm')->name('admin.login');
    Route::post('/login', 'AdminController@login')->name('admin.login.submit');
    Route::get('/logout', 'AdminController@logout')->name('admin.logout');
    Route::get('/', function () {
        return redirect()->route('admin.dashboard');  
    });
    Route::get('/dashboard', 'AdminController@index')->name('admin.dashboard');
});
=======
Route::group(['prefix' => 'admin'], function() {
    Route::get('/login', 'AuthAdmin\LoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'AuthAdmin\LoginController@login')->name('admin.login.submit');
    Route::get('/', 'AdminController@index')->name('admin.home');
});
>>>>>>> e07b1cb4aa087676456dc3b987e16ae4943721b4
