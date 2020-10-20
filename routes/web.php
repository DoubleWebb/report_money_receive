<?php

use Illuminate\Support\Facades\Route;

// Login Page
Route::get('/', 'Auth\AuthController@Login')->name('login');
// Dashboard Page
Route::get('dashboard', 'Page\DashboardController@Dashboard')->middleware('auth')->name('dashboard');
// Setting Special Days Page
Route::get('setting_special_days', 'Page\SettingController@Setting_Special_Days')->middleware('auth')->name('setting_special_days');

// All API
Route::group(['prefix' => 'api/v1'], function () {
    // Auth
    Route::post('do_login', 'Auth\AuthController@Do_Login');
    Route::post('do_register', 'Auth\AuthController@Do_Register');
    Route::get('do_logout', 'Auth\AuthController@Do_Logout')->name('do_logout');
    // Page Dashboard
    Route::get('get_employee_all', 'Page\DashboardController@Get_Employee_All');
    Route::post('load_select_empolyee', 'Page\DashboardController@Load_Select_Empolyee');
    Route::get('get_table_emplyee_work', 'Page\DashboardController@Get_Table_Emplyee_Work');
    Route::post('load_empolyee_data', 'Page\DashboardController@Load_Empolyee_Data');
    Route::post('load_dashboard_data', 'Page\DashboardController@Load_Dashboard_Data');
    Route::post('change_the_amount', 'Page\DashboardController@Change_The_Amount');
    Route::post('save_choose_a_reduction', 'Page\DashboardController@Save_Choose_A_Reduction');
    // Page Setting
    Route::get('get_table_setting_special_days', 'Page\SettingController@Get_Table_Setting_Special_Days');
    Route::post('save_create_special_day', 'Page\SettingController@Save_Create_Special_Day');
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