<?php

use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::get('home', 'HomeController@index')->name('home');

Route::prefix('admin')->group(function () {
    Route::get('/', 'AdminSessionController@index');
    Route::post('login', 'AdminSessionController@store');
    Route::get('logout', 'AdminSessionController@destroy');

    Route::middleware(['auth'])->group(function () {
        Route::get('dashboard', function () {
            return view('admin.index');
        })->name('dashboard');

        Route::middleware(['is_admin'])->group(function () {
            Route::get('roles/list', 'RoleController@roles');
            Route::get('roles', 'UserController@index');
            Route::resource('roles', 'RoleController')->only(['store', 'update', 'destroy']);

            Route::get('users/list', 'UserController@records');
            Route::put('users/{user}/status', 'UserController@status');
            Route::get('users/{user}/edit', 'UserController@index');
            Route::get('users/{user}/details', 'UserController@details');
            Route::resource('users', 'UserController')->except(['show', 'create', 'edit']);
        });
    });
});

Auth::routes();
