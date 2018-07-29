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
    Route::put('/password/create', 'SocialAccountController@createPassword')->name('password.create');
    Route::get('/connect/{provider}',          'SocialAccountController@connect')->name('oauth.connect');
    // Route::get('/connect/{provider}/callback', 'SocialAccountController@connect');
});

Route::group(['prefix' => 'dashboard'], function () {
    Route::get('/', function(){
        return redirect()->route('dashboard', ['menu' => 'overview']);
    }); 
    Route::get('/{menu?}/{section?}', 'MemberController@index')
            ->where(
                ['menu'     => '(overview|setting|sudut|negeri)', 
                'section'   => '(profile|account|projects|donations|activity)']
            )
            ->name('dashboard');
    Route::get('sudut/projects/manage/{slug}', 'ProjectController@manage')->name('project.manage');
    Route::put('setting/profile/edit/{id}', 'MemberController@editProfile')->name('profile.edit');
});

Route::group(['prefix' => 'admin'], function () {
    Route::get('login', 'AdminController@showLoginForm')->name('admin.login')->middleware(['guest']);
    Route::post('login', 'AdminController@login')->name('admin.login.submit')->middleware(['guest']);
    Route::get('logout', 'AdminController@logout')->name('admin.logout');
    Route::get('/', function () {
        return redirect()->route('admin.dashboard');  
    });
    Route::get('dashboard/{menu?}', 'AdminController@index')
            ->where(
                ['menu'     => '(overview|users|donations)',]
            )
            ->name('admin.dashboard');
});

Route::group(['prefix' => 'project'], function () {
    Route::get('browse/{category}', 'ProjectController@index')->name('project.browse');
    Route::get('details/{slug}/{menu?}', 'ProjectController@show')
            ->where(
                ['menu'     => '(detail|history|sinegeri|faq)']
            )
            ->name('project.show');
    Route::get('details/{slug}/donate', 'DonationController@create')->name('donation.create');
    Route::get('details/{slug}/donate/invoice', 'DonationController@invoice')->name('donation.invoice');
    Route::get('details/{slug}/volunteer-reg', 'VolunteerController@create')->name('volunteer.create');
    // Route::get('details/{slug}/volunteer-reg/post-reg', 'VolunteerController@create')->name('volunteer.create');

    Route::get('edit/{id}', 'ProjectController@edit')->name('project.edit');
    Route::put('update/{id}', 'ProjectController@update')->name('project.update');
    Route::delete('delete/{id}', 'ProjectController@destroy')->name('project.delete');
    Route::get('create', 'ProjectController@create')->name('project.create');
    Route::post('store', 'ProjectController@store')->name('project.store');

    Route::resource('history', 'DataHistorisController');
    Route::get('history/create/{projectId?}', 'DataHistorisController@create')->name('history.create');
});

Route::group(['prefix' => 'donation', 'middleware' => 'web'], function () {
    Route::post('store', 'DonationController@store')->name('donation.store');
});

Route::group(['prefix' => 'volunteer', 'middleware' => 'web'], function () {
    Route::post('store', 'VolunteerController@store')->name('volunteer.store');
});

Route::group(['prefix' => 'component'], function () {
    Route::get('modal-body/{parent_directory?}/{content}', 'ComponentContentController@getModalBody')->name("get.modal");
    Route::get('modal','ComponentContentController@loadModal')->name('load.modal');
});

Route::get('json/option/{table}', function (\Illuminate\Http\Request $request, $table) {
    $id = $request->id;
    if($table == 'regencies'){
        $data = \App\Regency::where('province_id', $id)->get();
    }

    if($table == 'districts'){
        $data = \App\District::where('regency_id', $id)->get();
    }
    
    return response()->json($data);
})->name('json.option');

Route::post('location', function (\Illuminate\Http\Request $request) {
    $key = $request->key;

    $items = \App\Regency::where("name","like","%$key%")->pluck('name');

    return response()->json(["items" => $items]);
})->name('get.location');