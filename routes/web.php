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
})->name('home');

Auth::routes();

//Main website redirection
Route::get('/register/{package}', 'Frontend\MainSiteRedirectController@redirectToRegister')
    ->where(['package' => 'basic|model|complete']);

//User routes............
Route::group(['middleware' => ['auth', 'checkUserStatus'], 'namespace' => 'Frontend'], function(){

    /*Route::get('home', function () {
        return view('home');
    });*/

    //Profile
    Route::get('profile', 'UserController@profile')->name('profile');
    Route::put('profile/{user}', 'UserController@updateProfile')->name('profile.update');
    Route::get('renew', 'UserController@renew')->name('user.renew');

    //Password
    Route::get('password-change', 'UserController@changePassword')->name('password.change');
    Route::post('password-update', 'UserController@updatePassword')->name('password.update');

    Route::group(['middleware' => ['checkDepartment']], function() {

        //Study
        Route::get('study', 'StudyController@showSelectSubject')->name('study.select-subject');
        Route::post('study', 'StudyController@selectSubject')->name('study.select-subject');
        Route::get('study/question', 'StudyController@question')->name('study.question');
        Route::post('study/question', 'StudyController@submitQuestion')->name('study.question.submit');
        Route::post('study/finished', 'StudyController@finished')->name('study.question.finished');

        Route::group(['middleware' => ['paidUser']], function() {

            //Practice
            Route::get('practice', 'PracticeController@showSelectSubject')->name('practice.select-subject');
            Route::post('practice', 'PracticeController@selectSubject')->name('practice.select-subject');
            Route::get('practice/question', 'PracticeController@question')->name('practice.question');
            Route::post('practice/question', 'PracticeController@submitQuestion')->name('practice.question.submit');
            Route::get('practice/summery', 'PracticeController@summery')->name('practice.summery');
            Route::post('practice/finished', 'PracticeController@finished')->name('practice.question.finished');
            Route::post('practice/restart', 'PracticeController@restart')->name('practice.question.restart');

            Route::group(['middleware' => ['accessExam']], function() {

                //Examination
                Route::get('examination', 'ExaminationController@prepareExam')->name('examination.prepare');
                Route::get('examination/start/{exam_notification_id}', 'ExaminationController@startExam')->name('examination.start');
                Route::get('examination/question', 'ExaminationController@question')->name('examination.question');
                Route::post('examination/question', 'ExaminationController@submitQuestion')->name('examination.question.submit');
                Route::get('examination/summery', 'PracticeController@summery')->name('examination.summery');
                Route::post('examination/finished', 'PracticeController@finished')->name('examination.question.finished');
                Route::get('examination/top-scorer', 'TopScorerController@index')->name('examination.topScorer');
            });
        });
     });

    Route::group(['middleware' => ['paidUser']], function() {

        //Library
        Route::get('libraries', 'LibraryController@index')->name('libraries.index');

        Route::group(['middleware' => ['checkDepartment']], function() {

            //Video
            Route::get('video', 'VideoController@index')->name('video.index');
            Route::get('video/{subject}', 'VideoController@videos')->name('video.video-list');
        });

        //Routine
        Route::get('routines', 'RoutineController@index')->name('routines.index');
    });
});



//Admin routes.........
Route::group(['middleware' => ['auth', 'admin'], 'as' => 'admin.', 'namespace' => 'Admin'], function(){

    //Clear cache
    Route::get('cache', function () {
        \Illuminate\Support\Facades\Artisan::call('cache:clear');
        \Illuminate\Support\Facades\Artisan::call('config:clear');
        \Illuminate\Support\Facades\Artisan::call('view:clear');
        \Illuminate\Support\Facades\Artisan::call('route:clear');
        \Illuminate\Support\Facades\Artisan::call('optimize:clear');

        echo 'Cache clear successful.';
    });

    Route::get('home', function () {
        return view('home');
    });

	//Departments
	Route::resource('departments', 'DepartmentController');
    Route::get('departments/edit/{department}', 'DepartmentController@edit')->name('department.edit');
    Route::post('departments/update/{department}', 'DepartmentController@update')->name('department.update');
    Route::get('get-department-list', 'DepartmentController@getDepartmentList')->name('get-department-list');

	//Subjects
	Route::resource('subjects', 'SubjectController');
    Route::get('subjects/edit/{subject}', 'SubjectController@edit')->name('subject.edit');
    Route::post('subjects/update/{subject}', 'SubjectController@update')->name('subject.update');

	//Questions
	Route::resource('questions', 'QuestionController');
    Route::get('questions/show/{question}', 'QuestionController@show')->name('question.show');
	Route::get('get-option-list', 'QuestionController@getOptionList')->name('get-option-list');

    //Question Template
    Route::resource('question-templates', 'QuestionTemplateController');

	//Users
	Route::get('users', 'UserController@index')->name('users.index');
	Route::get('users/edit/{user}', 'UserController@edit')->name('user.edit');
	Route::post('users/update/{user}', 'UserController@update')->name('user.update');

	//Notifications
    Route::resource('notifications', 'NotificationController');

    //Payments
    Route::get('payments', 'PaymentController@index')->name('payments.index');

    //Videos
    Route::resource('videos', 'VideoController');
});


// SSLCOMMERZ Start
Route::group(['middleware' => 'auth'], function(){

    Route::get('/payment', 'SslCommerzPaymentController@exampleHostedCheckout')->name('payment');

    Route::post('/pay', 'SslCommerzPaymentController@index');

    Route::post('/success', 'SslCommerzPaymentController@success');
    Route::post('/fail', 'SslCommerzPaymentController@fail');
    Route::post('/cancel', 'SslCommerzPaymentController@cancel');

    Route::post('/ipn', 'SslCommerzPaymentController@ipn');
});
//SSLCOMMERZ END

//Socialite
Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('login/{provider}/callback', 'Auth\LoginController@handleProviderCallback');
