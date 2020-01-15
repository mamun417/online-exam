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


Auth::routes();

Route::group(['middleware' => 'auth'], function(){

	Route::get('admin', function () {
	    return redirect('dashboard');
	});

	Route::get('dashboard', function () {
	    return view('backend.dashboard.index');
	});

	//Departments
	Route::resource('departments','Backend\DepartmentController');

	//Subjects
	Route::resource('subjects','Backend\SubjectController');

	//Examinations
	Route::resource('examinations','Backend\ExaminationController');

	//Users
	Route::resource('users', 'UserController');
});