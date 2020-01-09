<?php

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
    return view('backend.dashboard.index');
});

Route::get('dashboard', function () {
    return view('backend.dashboard.index');
});

//Department all route here
Route::resource('departments','Backend\DepartmentController');

//Subject all route here
Route::resource('subjects','Backend\SubjectController');

Auth::routes();

Route::get('home', 'HomeController@index')->name('home');

