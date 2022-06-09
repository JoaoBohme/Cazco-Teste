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

Route::namespace('App')->group(function() {

    Route::redirect('/', 'user/login');
    
    Route::prefix('admin')->group(function () {
        
        Route::get('/login', 'Http\Controllers\Admin\AdminController@login')->middleware('isAdminAlreadyLogged');
        Route::post('/login', 'Http\Controllers\Admin\AdminController@authenticate')->middleware('isAdminAlreadyLogged');
        
        Route::get('/forgot-password', 'Http\Controllers\Admin\AdminController@forgotPassword');
        Route::post('/forgot-password', 'Http\Controllers\Admin\AdminController@forgotPasswordSendEmail');
        
        Route::get('/password-recovery/{email}', 'Http\Controllers\Admin\AdminController@passwordRecovery');
        Route::put('/password-recovery/{email}', 'Http\Controllers\Admin\AdminController@updatePasswordRecovery');
        
        Route::get('/users', 'Http\Controllers\Admin\AdminController@users')->middleware('isAdminLogged');
        Route::delete('/users/{id}', 'Http\Controllers\Admin\AdminController@destroyUser')->middleware('isAdminLogged');
        
        Route::get('/create', 'Http\Controllers\Admin\AdminController@createUser')->middleware('isAdminLogged');
        Route::post('/create', 'Http\Controllers\Admin\AdminController@storeUser')->middleware('isAdminLogged');
        
        Route::get('/edit/{id}', 'Http\Controllers\Admin\AdminController@editUser')->middleware('isAdminLogged');
        Route::put('/edit/{id}', 'Http\Controllers\Admin\AdminController@updateUser')->middleware('isAdminLogged');
        
        Route::get('/reports/{id}', 'Http\Controllers\Admin\AdminController@indexReports')->middleware('isAdminLogged');

        Route::get('/logout', 'Http\Controllers\Admin\AdminController@logout')->middleware('isAdminLogged');
    });

    Route::prefix('user')->group(function () {
        
        Route::get('/login', 'Http\Controllers\User\UserController@login')->middleware('isUserAlreadyLogged');
        Route::post('/login', 'Http\Controllers\User\UserController@authenticate')->middleware('isUserAlreadyLogged');
        
        Route::get('/forgot-password', 'Http\Controllers\User\UserController@forgotPassword');
        Route::post('/forgot-password', 'Http\Controllers\User\UserController@forgotPasswordSendEmail');
        
        Route::get('/password-recovery/{email}', 'Http\Controllers\User\UserController@passwordRecovery');
        Route::put('/password-recovery/{email}', 'Http\Controllers\User\UserController@updatePasswordRecovery');
        
        Route::get('/create-report', 'Http\Controllers\User\UserController@indexCreateReports')->middleware('isUserLogged');
        Route::post('/create-report/{id}', 'Http\Controllers\User\UserController@storeReports')->middleware('isUserLogged');
        
        Route::get('/edit-report/{id}', 'Http\Controllers\Report\ReportController@show')->middleware('isUserLogged');
        Route::put('/edit-report/{id}', 'Http\Controllers\Report\ReportController@update')->middleware('isUserLogged');

        Route::get('/reports', 'Http\Controllers\User\UserController@indexReports')->middleware('isUserLogged');
        Route::get('/reports', 'Http\Controllers\Report\ReportController@indexUsers')->middleware('isUserLogged');

        Route::get('/logout', 'Http\Controllers\User\UserController@logout')->middleware('isUserLogged');
    });
});