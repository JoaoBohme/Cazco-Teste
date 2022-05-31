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
    Route::get('/', 'Http\Controllers\Site\HomeController');
    
    Route::get('admin/login', 'Http\Controllers\Site\Admin\LoginController@index');
    Route::get('admin/forgot-password', 'Http\Controllers\Site\Admin\ForgotPasswordController@index');
    Route::get('admin/password-recovery', 'Http\Controllers\Site\Admin\PasswordRecoveryController@index');
    Route::get('admin/users', 'Http\Controllers\Site\Admin\UsersController@index');
    Route::get('admin/create', 'Http\Controllers\Site\Admin\CreateController@index');
    Route::get('admin/edit', 'Http\Controllers\Site\Admin\EditController@index');

    Route::get('user/login', 'Http\Controllers\Site\UserController@index');
    Route::get('user/forgot-password', 'Http\Controllers\Site\UserController@index');
    Route::get('user/password-recovery', 'Http\Controllers\Site\UserController@index');
});