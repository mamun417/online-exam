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

	Route::get('/', function () {
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

	//Questions
	Route::resource('questions','Backend\QuestionController');

	//users
	Route::get('show-profile', 'UserController@getProfile')->name('show.profile');
	Route::PUT('user/profile/{user}', 'UserController@updateProfile')->name('update.profile');

	Route::get('password-change', 'UserController@changePassword')->name('password.change');
	Route::POST('password-update', 'UserController@updatePassword')->name('password.update');
});

