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
//    Route::get('/', function () {
//        dd(route('login'));
//    })->name('welcome');
    Route::view('/', 'welcome')->name('welcome');

    Auth::routes();

    Route::namespace('Admin')
        ->prefix('admin')
        ->name('admin.')
        ->middleware(['auth', 'permission:access-admin-page'])
        ->group(function () {
            Route::resource('dashboard', 'DashboardController');

            Route::resource('users', 'UserController');
            Route::resource('roles', 'RoleController');
            Route::resource('permissions', 'PermissionController');

            Route::redirect('/', route('admin.dashboard.index', app()->getLocale()))->name("default");
        });

    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/demands/taken', 'DemandController@taken')->name('demands.taken');

    Route::resource('demands', 'DemandController')
        ->middleware('auth');

    Route::get('/requests', 'RequestController@index')->name('requests.index');
});
