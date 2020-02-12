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

    //Study
    Route::get('study', 'StudyController@showSelectSubject')->name('study.select-subject');
    Route::post('study', 'StudyController@selectSubject')->name('study.select-subject');
    Route::get('study/question/{question?}', 'StudyController@question')->name('study.question');
    Route::post('study/question', 'StudyController@submitQuestion')->name('study.question.submit');
    Route::post('study/finished', 'StudyController@finished')->name('study.finished');
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
	Route::get('users/edit/{user}', 'Backend\UserController@edit')->name('user.edit');
	Route::post('users/update/{user}', 'Backend\UserController@update')->name('user.update');
});


