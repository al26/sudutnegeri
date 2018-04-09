<?php

use Illuminate\Support\Facades\Storage;

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
    $data['carousel_img'] = Storage::files('public/homepage_carousel');
    $data['carousel_url'] = Storage::url('public/homepage_carousel/');
    $data['sponsor_img'] = Storage::files('public/sponsors_logo');
    $data['sponsor_url'] = Storage::url('public/sponsors_logo/');
    $data['profile_img'] = Storage::files('public/profile_pictures');
    $data['profile_url'] = Storage::url('public/profile_pictures/');
    // dd($data);
    return view('home', $data);
});

Auth::routes();
Route::namespace('Auth')->group(function () {
    Route::get('/logout', 'LoginController@logout')->name('logout');
    Route::get('/auth/{provider}',          'SocialAccountController@redirectToProvider')->name('oauth.login');
    Route::get('/auth/{provider}/callback', 'SocialAccountController@handleProviderCallback');
});
Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin'], function () {
    Route::get('/login', 'AdminController@showLoginForm')->name('admin.login')->middleware(['guest']);
    Route::post('/login', 'AdminController@login')->name('admin.login.submit')->middleware(['guest']);
    Route::get('/logout', 'AdminController@logout')->name('admin.logout');
    Route::get('/', function () {
        return redirect()->route('admin.dashboard');  
    });
    Route::get('/dashboard', 'AdminController@index')->name('admin.dashboard');
});
