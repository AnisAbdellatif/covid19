<?php

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

Route::redirect('/', '/en');

Route::group(['prefix' => '{language}'], function () {
    Route::view('/', 'welcome')->name('welcome');

    Auth::routes();

    Route::namespace('Admin')
        ->prefix('admin')
        ->name('admin.')
        ->middleware(['auth', 'permission:access-admin-page'])
        ->group(function () {
            Route::resource('dashboard', 'DashboardController');

            Route::get('users/search', 'UserController@search')->name('users.search')->middleware(['auth', 'permission:access-auth-panel']);
            Route::resource('users', 'UserController')->middleware(['auth', 'permission:access-auth-panel']);

            Route::resource('roles', 'RoleController')->middleware(['auth', 'permission:access-auth-panel']);

            Route::resource('permissions', 'PermissionController')->middleware(['auth', 'permission:access-auth-panel']);

            Route::resource('requests', 'RequestController');

            Route::redirect('/', route('admin.dashboard.index', app()->getLocale()))->name("default");
        });

    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/demands/taken', 'DemandController@taken')->name('demands.taken');

    Route::resource('demands', 'DemandController')
        ->middleware('auth');

    Route::namespace('Admin')
        ->middleware('auth')
        ->group(function () {
            Route::view('/change-password', 'auth.change_password')->name('change_password.edit');
            Route::patch('/change-password', 'UserController@updatePassword')->name('change_password.update');
        });
});
