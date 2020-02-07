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
    return view('home');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function(){

	Route::get('dashboard', function () {
	    return view('backend.dashboard.index');
	});

	//Departments
	Route::resource('departments', 'Backend\DepartmentController');

	//Subjects
	Route::resource('subjects', 'Backend\SubjectController');

	//Questions
	Route::resource('questions', 'Backend\QuestionController');
	Route::get('get-option-list', 'Backend\QuestionController@getOptionList')->name('get-option-list');

    //Question Template
    Route::resource('question-templates', 'Backend\QuestionTemplateController');

	//users
	Route::get('users', 'BackendUserController@index')->name('users.index');
	Route::get('user/expire/date/{user}', 'BackendUserController@expireDateEdit')->name('user-expire-date.edit');
	Route::post('user/expire/date/{user}', 'BackendUserController@expireDateUpdate')->name('user-expire-date.update');

	Route::get('show-profile', 'UserController@getProfile')->name('show.profile');
	Route::put('user/profile/{user}', 'UserController@updateProfile')->name('update.profile');

	Route::get('password-change', 'UserController@changePassword')->name('password.change');
	Route::post('password-update', 'UserController@updatePassword')->name('password.update');
});

