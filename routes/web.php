<?php

Route::get('/', function () {
    return view('welcome');
});

/** -- -- -- CMS  -- -- -- */
Auth::routes(['verify' => true]);

Route::prefix('admin')->group(function () {
    Route::middleware(['auth'])->group(function () {
        Route::get('/dashboard', 'HomeController@index')->name('dashboard');

        Route::middleware(['pages_access'])->group(function () {
            Route::get('pages-list', 'PageController@pagesList');
            Route::put('pages/{page}/status', 'PageController@status');
            Route::get('pages/create', 'PageController@index');
            Route::get('pages/{page}/edit', 'PageController@edit');
            Route::resource('pages', 'PageController')->except(['show', 'create', 'edit']);
        });

        Route::middleware(['verified'])->group(function () {
            Route::get('profile', 'ProfileController@edit')->name('profile.edit');
            Route::put('profile', 'ProfileController@update')->name('profile.update');
            Route::put('profile/password', 'ProfileController@password')->name('profile.password');
        });

        Route::middleware(['is_admin'])->group(function () {
            Route::get('roles-list', 'RoleController@rolesList');
            Route::resource('roles', 'RoleController')->except(['show', 'create', 'edit']);

            Route::put('users/{user}/status', 'UserController@status');
            Route::get('users-list', 'UserController@index');
            Route::get('users/create', 'UserController@index');
            Route::get('users/{user}/edit', 'UserController@edit');
            Route::resource('users', 'UserController')->except(['show', 'create', 'edit']);
        });
    });
});
