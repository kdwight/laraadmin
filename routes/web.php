<?php

Route::get('/', function () {
    return view('welcome');
});

Route::get('admin', 'AdminSessionController@create');
Route::post('admin', 'AdminSessionController@store');
Route::get('admin-logout', 'AdminSessionController@destroy');

Route::prefix('admin')->group(function () {
    Route::middleware(['auth'])->group(function () {
        Route::prefix('API')->group(function () {
            Route::get('/{user}/user-edit', 'UserController@edit');
        });

        Route::get('/{any}', 'UserController@index')->where(['any' => 'users.*|roles']);

        /* USER MANAGEMENT */
        Route::get('change-password/{user}', 'UserController@edit_password');
        Route::patch('change-password/{user}', 'UserController@update_password');
        Route::put('update-password/{user}', 'UserController@change_password');

        Route::get('users/data-table', 'UserController@index')->name('users.table');
        Route::patch('users/{user}/status', 'UserController@status');
        Route::resource('users', 'UserController');
    });
});
