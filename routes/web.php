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

//User routes............
Route::group(['middleware' => 'auth', 'namespace' => 'Frontend'], function(){

    Route::get('dashboard', function () {
        return view('backend.dashboard.index');
    });

    //Profile
    Route::get('profile', 'UserController@profile')->name('profile');
    Route::put('profile/{user}', 'UserController@updateProfile')->name('profile.update');

    //Password
    Route::get('password-change', 'UserController@changePassword')->name('password.change');
    Route::post('password-update', 'UserController@updatePassword')->name('password.update');
});



//Admin routes.........
Route::group(['middleware' => ['auth', 'admin']], function(){

	//Departments
	Route::resource('departments', 'Backend\DepartmentController');

	//Subjects
	Route::resource('subjects', 'Backend\SubjectController');

	//Questions
	Route::resource('questions', 'Backend\QuestionController');
	Route::get('get-option-list', 'Backend\QuestionController@getOptionList')->name('get-option-list');

    //Question Template
    Route::resource('question-templates', 'Backend\QuestionTemplateController');

	//Users
	Route::get('users', 'Backend\UserController@index')->name('users.index');
	Route::get('user/expire/date/{user}', 'Backend\UserController@expireDateEdit')->name('user-expire-date.edit');
	Route::post('user/expire/date/{user}', 'Backend\UserController@expireDateUpdate')->name('user-expire-date.update');
});


