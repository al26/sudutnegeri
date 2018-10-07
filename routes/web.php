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
    $data['projects'] = \App\Project::take(10)->get();
    // dd(\App\User::all());
    $data['member'] = \App\User::where('role', 'member')->where('active', true)->get();
    return view('home', $data);
});

Auth::routes();
Route::namespace('Auth')->group(function () {
    Route::get('/logout', 'LoginController@logout')->name('logout');
    Route::get('/auth/{provider}',          'SocialAccountController@redirectToProvider')->name('oauth.login');
    Route::get('/auth/{provider}/callback', 'SocialAccountController@handleProviderCallback');
    Route::get('/activate-account', 'AccountActivationController@activateAccount')->name('auth.activate');
    Route::get('/activate-account/resend', 'AccountActivationController@showResendActivationEmailForm')->name('auth.activate.resend');
    Route::post('/activate-account/resend', 'AccountActivationController@resendActivationEmail');
    Route::put('/password/create', 'SocialAccountController@createPassword')->name('password.create');
    // Route::get('/connect/{provider}',          'SocialAccountController@connect')->name('oauth.connect');
    Route::get('/disconnect/{provider}/{continue}', 'SocialAccountController@disconnect')->name('oauth.disconnect');
});

Route::group(['prefix' => 'dashboard'], function () {
    Route::get('/', function(){
        return redirect()->route('dashboard', ['menu' => 'overview']);
    }); 
    Route::get('/{menu?}/{section?}', 'MemberController@index')
            ->where(
                ['menu'     => '(overview|setting|sudut|negeri)', 
                'section'   => '(profile|account|projects|donations|activity|volunteer|cv|verify|withdrawal)']
            )
            ->name('dashboard');
    Route::get('sudut/projects/manage/{slug}', 'ProjectController@manage')->name('project.manage');
    Route::get('sudut/projects/manage/{slug}/history/create', 'DataHistorisController@create')->name('history.create');
    Route::get('sudut/projects/manage/{slug}/history/edit/{id}', 'DataHistorisController@edit')->name('history.edit');
    Route::get('sudut/projects/create', 'ProjectController@create')->name('project.create');
    Route::get('sudut/projects/edit/{id}', 'ProjectController@edit')->name('project.edit');
    Route::get('sudut/withdrawal/create', 'WithdrawalController@create')->name('withdrawal.create');
    Route::put('setting/profile/edit/{id}', 'MemberController@editProfile')->name('profile.edit');
    Route::get('setting/profile/avatar/edit/{id}','MemberController@editProfilePicture')->name('avatar.edit');
    Route::put('setting/profile/avatar/update/{id}','MemberController@updateProfilePicture')->name('avatar.update');
    Route::get('negeri/donations/upload/{id}', 'DonationController@uploadReceipt')->name('donation.upreceipt');
    Route::put('negeri/donations/upload/{id}', 'DonationController@saveReceipt')->name('donation.savereceipt');
    Route::get('negeri/donations/receipt/{id}', 'DonationController@showReceipt')->name('donation.receipt');
    Route::get('negeri/activity/manage/{slug}', 'DataHistorisController@manage')->name('history.manage');
    Route::get('negeri/activity/manage/{slug}/history/create', 'DataHistorisController@createFromVolunteer')->name('activity.history.create');
    Route::get('negeri/activity/manage/{slug}/history/edit/{id}', 'DataHistorisController@editFromVolunteer')->name('activity.history.edit');
    Route::put('/password/change', 'MemberController@changePassword')->name('password.change');
    Route::put('/account/verify', 'MemberController@verifyAccount')->name('account.verify');
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
    Route::get('browse', 'ProjectController@index')->name('project.browse');
    Route::get('details/{slug}/{menu?}', 'ProjectController@show')
            ->where(
                ['menu'     => '(detail|history|sinegeri|faq)']
            )
            ->name('project.show');
    Route::get('details/{slug}/donate', 'DonationController@create')->name('donation.create');
    Route::get('details/{slug}/donate/invoice', 'DonationController@invoice')->name('donation.invoice');
    Route::get('details/{slug}/volunteer-reg', 'VolunteerController@create')->name('volunteer.create');
    Route::get('details/{slug}/volunteer-reg/post-msg', 'VolunteerController@postmsg')->name('volunteer.postmsg');

    Route::resource('project', 'ProjectController')->only(['store', 'update', 'destroy']);
    // Route::get('edit/{id}', 'ProjectController@edit')->name('project.edit');
    // Route::put('update/{id}', 'ProjectController@update')->name('project.update');
    // Route::delete('delete/{id}', 'ProjectController@destroy')->name('project.delete');
    // Route::get('create', 'ProjectController@create')->name('project.create');
    Route::post('store', 'ProjectController@store')->name('project.store');
    Route::resource('withdrawal', 'WithdrawalController')->only(['store', 'update', 'destroy']);
    Route::resource('history', 'DataHistorisController')->only(['store', 'update', 'destroy']);
});

Route::group(['prefix' => 'donation', 'middleware' => 'web'], function () {
    Route::post('store', 'DonationController@store')->name('donation.store');
});

Route::group(['prefix' => 'volunteer', 'middleware' => 'web'], function () {
    Route::post('store', 'VolunteerController@store')->name('volunteer.store');
    Route::get('show/{id}', 'VolunteerController@show')->name('volunteer.show');
    Route::put('update/{id}', 'VolunteerController@update')->name('volunteer.update');
    Route::put('accept/{id}', 'VolunteerController@accept')->name('volunteer.accept');
    Route::put('reject/{id}', 'VolunteerController@reject')->name('volunteer.reject');
});

Route::group(['prefix' => 'component'], function () {
    Route::get('modal-body/{parent_directory?}/{content}', 'ComponentContentController@getModalBody')->name("get.modal");
    Route::get('modal','ComponentContentController@loadModal')->name('load.modal');
});

Route::group(['prefix' => 'json'], function () {
    Route::get('saldo', function(\Illuminate\Http\Request $request) {
        // $id = base64_decode(urldecode($request->project));
        $id = decrypt($request->project);
        $project = \App\Project::findOrFail($id)->select('project_name','collected_funds')->get()[0];
        $credited = \App\Withdrawal::where('project_id', $id)
                                    ->where('status', 'processed')
                                    ->sum('amount');
        $data['saldo'] = $project->collected_funds - $credited;
        $data['name'] = $project->project_name;

        return response()->json($data, 200);
    })->name('get.saldo');

    Route::get('option/{table}', function (\Illuminate\Http\Request $request, $table) {
        $id = $request->id;
        if($table == 'regencies'){
            $data = \App\Regency::where('province_id', $id)->get();
        }
    
        if($table == 'districts'){
            $data = \App\District::where('regency_id', $id)->get();
        }
        
        return response()->json($data);
    })->name('json.option');

    Route::get('projects', function (\Illuminate\Http\Request $request) {
        $projects = new \App\Project();
        $data = null;

        if(!empty($request->key)){
            $key = $request->key;
            $regencies = App\Regency::where('name', 'LIKE', '%'.$key.'%')->pluck('id')->toArray();
            $data = $projects->where('project_name','LIKE','%'.$key.'%')
                             ->orWhereIn('regency_id', $regencies)
                             ->with('user.profile','location')->get();
        }
        
        // dd(json_encode($data));
        return response()->json($data);
    });

    Route::get('avatar', function (\Illuminate\Http\Request $request) {
        $res = \App\User_profile::where("id", decrypt($request->id))->pluck('profile_picture');
        return response()->json($res, 200);
    })->name('pchange');
    
});


Route::post('location', function (\Illuminate\Http\Request $request) {
    $key = $request->key;

    $items = \App\Regency::where("name","like","%$key%")->select('name', 'id')->get();

    return response()->json(["items" => $items]);
})->name('get.location');

// Route::get('location-id', function (\Illuminate\Http\Request $request) {
//     $key = $request->key;

//     $items = \App\Regency::where("id","like","%$key%")->select('name', 'id')->get();

//     return response()->json(["items" => $items]);
// })->name('get.location.id');

Route::get('{path}', function(\Illuminate\Http\Request $request, $path){
    return public_path($path);
})->middleware('auth')->name('file.view');