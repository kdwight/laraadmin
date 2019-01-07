<?php

Route::get('/', 'PageController@welcome');

// -- -- -- CMS  -- -- --

//admin sessions
Route::get('/admin', 'AdminSessionController@create')->name('login');
Route::post('/admin_login', 'AdminSessionController@store');
Route::get('/admin_logout', 'AdminSessionController@destroy');

Route::group(['middleware' => ['auth']], function () {

    Route::patch('/pages/{page}/status', 'PageController@status');
    Route::resource('pages', 'PageController');

    /* USER MANAGEMENT */
    Route::get('users/{user}/change-password', 'UserController@edit_password');
    Route::patch('users/{user}/change-password', 'UserController@update_password');

    Route::get('users/roles', 'UserController@roles');
    Route::post('users/roles', 'UserController@store_role');
    Route::get('users/{role}/edit-role', 'UserController@edit_role');
    Route::patch('users/{role}/update-role', 'UserController@update_role');
    Route::delete('users/{role}/delete-role', 'UserController@destroy_role');

    Route::get('users/export', 'UserController@export_users');
    Route::post('users/sort', 'UserController@updateOrder');
    Route::patch('/users/{user}/status', 'UserController@status');
    Route::resource('users', 'UserController');
});
