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
        
        Route::get('/login', 'Http\Controllers\Admin\AdminController@login');
        Route::post('/login', 'Http\Controllers\Admin\AdminController@authenticate');
        
        Route::get('/forgot-password', 'Http\Controllers\Admin\AdminController@forgotPassword');
        Route::post('/forgot-password', 'Http\Controllers\Admin\AdminController@forgotPasswordSendEmail');
        
        Route::get('/password-recovery/{email}', 'Http\Controllers\Admin\AdminController@passwordRecovery');
        Route::put('/password-recovery/{email}', 'Http\Controllers\Admin\AdminController@updatePasswordRecovery');
        
        Route::get('/users', 'Http\Controllers\Admin\AdminController@users');
        Route::delete('/users/{id}', 'Http\Controllers\Admin\AdminController@destroyUser');
        
        Route::get('/create', 'Http\Controllers\Admin\AdminController@createUser');
        Route::post('/create', 'Http\Controllers\Admin\AdminController@storeUser');
        
        Route::get('/edit/{id}', 'Http\Controllers\Admin\AdminController@editUser');
        Route::put('/edit/{id}', 'Http\Controllers\Admin\AdminController@updateUser');
        
        Route::get('/reports/{id}', 'Http\Controllers\Admin\AdminController@indexReports');

        Route::get('/logout', 'Http\Controllers\Admin\AdminController@logout');
    });

    Route::prefix('user')->group(function () {
        
        Route::get('/login', 'Http\Controllers\User\UserController@login');
        Route::post('/login', 'Http\Controllers\User\UserController@authenticate');
        
        Route::get('/forgot-password', 'Http\Controllers\User\UserController@forgotPassword');
        Route::post('/forgot-password', 'Http\Controllers\User\UserController@forgotPasswordSendEmail');
        
        Route::get('/password-recovery/{email}', 'Http\Controllers\User\UserController@passwordRecovery');
        Route::put('/password-recovery/{email}', 'Http\Controllers\User\UserController@updatePasswordRecovery');
        
        Route::get('/create-report', 'Http\Controllers\User\UserController@indexCreateReports');
        Route::post('/create-report/{id}', 'Http\Controllers\User\UserController@storeReports');
        
        Route::get('/edit-report/{id}', 'Http\Controllers\Report\ReportController@show');
        Route::put('/edit-report/{id}', 'Http\Controllers\Report\ReportController@update');

        Route::get('/reports', 'Http\Controllers\User\UserController@indexReports');
        Route::get('/reports', 'Http\Controllers\Report\ReportController@indexUsers');

        Route::get('/logout', 'Http\Controllers\User\UserController@logout');
    });
});