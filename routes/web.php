<?php

Route::get('/', function () {
    return view('welcome');
});

/** -- -- -- CMS  -- -- -- */
Auth::routes(['verify' => true]);

Route::prefix('admin')->group(function () {
    Route::middleware(['auth'])->group(function () {
        Route::get('/dashboard', 'HomeController@index')->name('dashboard');

        // Route::middleware(['pages_access'])->group(function () {
        //     Route::put('pages/{page}/status', 'PageController@status');
        //     Route::resource('pages', 'PageController');
        // });

        Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
        Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
        Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);

        /* USER MANAGEMENT */
        Route::get('users/{user}/change-password', 'UserController@edit_password');
        Route::put('users/{user}/change-password', 'UserController@update_password');

        Route::get('users/roles', 'UserController@roles');
        Route::post('users/roles', 'UserController@store_role');
        Route::get('users/{role}/edit-role', 'UserController@edit_role');
        Route::put('users/{role}/update-role', 'UserController@update_role');
        Route::delete('users/{role}/delete-role', 'UserController@destroy_role');

        Route::post('userlist', 'UserController@userList');
        Route::put('/users/{user}/status', 'UserController@status');
        Route::resource('users', 'UserController', ['except' => ['show']]);
    });
});
