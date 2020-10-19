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
    // Page
    Route::get('get_employee_all', 'Page\DashboardController@Get_Employee_All');
    Route::post('load_select_empolyee', 'Page\DashboardController@Load_Select_Empolyee');
    Route::get('get_table_emplyee_work', 'Page\DashboardController@Get_Table_Emplyee_Work');
});

// Cronjob
Route::group(['prefix' => 'api/cronjob'], function () {
    // Auto
    Route::get('create_date_work', 'Cronjob\Create_Date_Controller@Create_Date_Work');
    Route::get('update_date_work', 'Cronjob\Update_Date_Controller@Update_Date_Work');
    Route::get('create_special_day', 'Cronjob\Create_Special_Day_Controller@Create_Special_Day');
    Route::get('update_money_work', 'Cronjob\Update_Money_Date_Controller@Update_Money_Work');
    // Mannal
    Route::get('create_date_work_mannal', 'Cronjob\Create_Date_Controller@Create_Date_Work_Mannal');
});

// All API Receive
Route::group(['prefix' => 'api/receive'], function () {
    // Employee
    Route::get('employee', 'API\EmployeeController@Receive_Employee');
    // Finger
    Route::get('finger', 'API\FingerController@Receive_Finger');
});