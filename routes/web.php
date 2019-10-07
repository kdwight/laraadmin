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

        Route::middleware(['verified'])->group(function () {
            Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
            Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
            Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
        });

        Route::middleware(['is_admin'])->group(function () {
            Route::get('roles-list', 'RoleController@rolesList', ['except' => ['show', 'create', 'edit']]);
            Route::resource('roles', 'RoleController', ['except' => ['show', 'create', 'edit']]);

            Route::patch('users/{user}/status', 'UserController@status');
            Route::get('users-list', 'UserController@index');
            Route::get('users/create', 'UserController@index');
            Route::get('users/{user}/edit', 'UserController@edit');
            Route::resource('users', 'UserController', ['except' => ['show', 'create', 'edit']]);
        });
    });
});
