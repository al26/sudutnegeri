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
    // $a = Storage::url('public/homepage_carousel');
    // dd($a);
    return view('home');
});

Auth::routes();
Route::namespace('Auth')->group(function () {
    Route::get('/logout', 'LoginController@logout')->name('logout');
    Route::get('/auth/{provider}',          'SocialAccountController@redirectToProvider')->name('oauth.login');
    Route::get('/auth/{provider}/callback', 'SocialAccountController@handleProviderCallback');
});

Route::group(['prefix' => 'dashboard'], function () {
    Route::get('/', function(){
        return redirect()->route('dashboard', ['menu' => 'overview']);
    }); 
    Route::get('/{menu?}/{section?}', 'MemberController@index')
            ->where(
                ['menu'     => '(overview|setting|sudut|negeri)', 
                'section'   => '(profile|account|campaigns|donations|activity)']
            )
            ->name('dashboard');
    Route::get('sudut/campaigns/manage/{id}', 'MemberController@manageCampaign')->name('manage.campaign');
});

Route::group(['prefix' => 'admin'], function () {
    Route::get('/login', 'AdminController@showLoginForm')->name('admin.login')->middleware(['guest']);
    Route::post('/login', 'AdminController@login')->name('admin.login.submit')->middleware(['guest']);
    Route::get('/logout', 'AdminController@logout')->name('admin.logout');
    Route::get('/', function () {
        return redirect()->route('admin.dashboard');  
    });
    Route::get('/dashboard', 'AdminController@index')->name('admin.dashboard');
});

Route::group(['prefix' => 'project'], function () {
    Route::get('browse/{category}', 'ProjectController@index')->name('project.browse');
    Route::get('details/{slug}', 'ProjectController@show')->name('project.show');
});
