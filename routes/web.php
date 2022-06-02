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
        
        Route::get('/forgot-password', 'Http\Controllers\Admin\AdminController@forgotPassword');
        
        Route::get('/password-recovery', 'Http\Controllers\Admin\AdminController@passwordRecovery');
        
        Route::get('/users', 'Http\Controllers\Admin\AdminController@users');
        
        Route::get('/create', 'Http\Controllers\Admin\AdminController@createUser');
        
        Route::get('/edit/{id}', 'Http\Controllers\Admin\AdminController@editUser');
        
        Route::get('/reports/{id}', 'Http\Controllers\Admin\AdminController@indexReports');
    });

    Route::prefix('user')->group(function () {
        
        Route::get('/login', 'Http\Controllers\User\UserController@login');
        
        Route::get('/forgot-password', 'Http\Controllers\User\UserController@forgotPassword');
        
        Route::get('/password-recovery', 'Http\Controllers\User\UserController@passwordRecovery');
        
        Route::get('/create-report', 'Http\Controllers\User\UserController@indexCreateReports');
        
        Route::get('/edit-report/{id}', 'Http\Controllers\Report\ReportController@show');

        Route::get('/reports', 'Http\Controllers\User\UserController@indexReports');
        Route::get('/reports', 'Http\Controllers\Report\ReportController@indexUsers');
    });
});