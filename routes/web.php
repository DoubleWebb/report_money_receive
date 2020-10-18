<?php

use Illuminate\Support\Facades\Route;

// Login Page
Route::get('/', 'Auth\AuthController@Login')->name('login');
// Dashboard Page
Route::get('dashboard', 'Page\DashboardController@Dashboard')->middleware('auth')->name('dashboard');

// All API
Route::group(['prefix' => 'api/v1'], function () {
    // Auth
    Route::post('do_login', 'Auth\AuthController@Do_Login');
    Route::post('do_register', 'Auth\AuthController@Do_Register');
    Route::get('do_logout', 'Auth\AuthController@Do_Logout')->name('do_logout');
});

// Cronjob
Route::group(['prefix' => 'api/cronjob'], function () {
    Route::get('create_date_work', 'Cronjob\Create_Date_Controller@Create_Date_Work');
});

// All API Receive
Route::group(['prefix' => 'api/receive'], function () {
    // Employee
    Route::get('employee', 'API\EmployeeController@Receive_Employee');
    // Finger
    Route::get('finger', 'API\FingerController@Receive_Finger');
});