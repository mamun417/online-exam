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
Route::get('/dashboard', function () {
    return view('backend.dashboard.index');
});
//Department all route here
Route::resource('department','Backend\DepartmentController');

//Subject all route here
Route::resource('subject','Backend\SubjectController');
Auth::routes();



Route::get('/home', 'HomeController@index')->name('home');
Route::get('test', 'Backend\TestController@test')->name('test');
Route::POST('test.create', 'Backend\TestController@testfunction')->name('test.create');
