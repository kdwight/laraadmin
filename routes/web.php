<?php

Route::get('/', function () {
    return view('welcome');
});

// -- -- -- CMS  -- -- --

//admin sessions
Route::get('/admin', 'AdminSessionController@create')->name('login');
Route::post('/admin_login', 'AdminSessionController@store');
Route::get('/admin-logout', 'AdminSessionController@destroy');

Route::prefix('admin')->group(function () {
    Route::middleware(['auth'])->group(function () {

        Route::get('dashboard', 'DashboardController@index');
        Route::post('activityLists', 'DashboardController@activityLists');

        Route::put('pages/{page}/status', 'PageController@status');
        Route::resource('pages', 'PageController');

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
        Route::resource('users', 'UserController');
    });
});
