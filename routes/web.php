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
    Route::get('/', function () {
        return view('welcome');
    });

    Auth::routes();

    Route::namespace('Admin')
        ->prefix('admin')
        ->name('admin.')
        ->middleware(['auth', 'permission:access-admin-page'])
        ->group(function () {
            Route::redirect('/', app()->getLocale().'/admin/dashboard')->name("default");

            Route::resource('dashboard', 'DashboardController');

            Route::resource('users', 'UserController');
            Route::resource('roles', 'RoleController');
            Route::resource('permissions', 'PermissionController');
        });

    Route::get('/home', 'HomeController@index')->name('home');

    Route::resource('demands', 'DemandController')
        ->middleware('auth');

    Route::get('/my_demands', 'DemandController@my')->name('my_demands');
});



//Route::get('demands', 'DemandController@index')
//    ->middleware('permission:access_demands_page');
//
//Route::get('demands/create', 'DemandController@create')
//    ->middleware('permission:make_demand');
//
//Route::post('demands', 'DemandController@store')
//    ->middleware('permission:make_demand');
//
//Route::delete('demands/{demand}', 'DemandController@destroy')
//    ->middleware('permission:delete_demand');

