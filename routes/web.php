<?php

use Illuminate\Support\Facades\Route;

// Login Page
Route::get('/', 'Auth\AuthController@Login')->name('login');
// Dashboard Page
Route::get('dashboard', 'Page\DashboardController@Dashboard')->middleware('auth')->name('dashboard');
// Setting Special Days Page
Route::get('setting_special_days', 'Page\SettingController@Setting_Special_Days')->middleware('auth')->name('setting_special_days');
// Setting Team Page
Route::get('setting_team', 'Page\SettingController@Setting_Team')->middleware('auth')->name('setting_team');
// Setting User Page
Route::get('setting_user', 'Page\SettingController@Setting_User')->middleware('auth')->name('setting_user');

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
    Route::get('get_table_holiday_in_advance', 'Page\DashboardController@Get_Table_Holiday_In_Advance');
    Route::post('save_holiday_in_advance', 'Page\DashboardController@Save_Holiday_In_Advance');
    // Page Setting Soecial Days
    Route::get('get_table_setting_special_days', 'Page\SettingController@Get_Table_Setting_Special_Days');
    Route::post('save_create_special_day', 'Page\SettingController@Save_Create_Special_Day');
    // Page Setting Team
    Route::post('get_card_setting_team', 'Page\SettingController@Get_Card_Setting_Team');
    Route::post('save_setting_team', 'Page\SettingController@Save_Setting_Team');
    // Page Setting User
    Route::get('get_table_setting_user', 'Page\SettingController@Get_Table_Setting_User');
    Route::get('get_select_team', 'Page\SettingController@Get_Select_Team');
    Route::post('save_create_user', 'Page\SettingController@Save_Create_User');
    Route::post('get_user_data', 'Page\SettingController@Get_User_Data');
    Route::post('save_edit_user', 'Page\SettingController@Save_Edit_User');
});

// Cronjob
Route::group(['prefix' => 'api/cronjob'], function () {
    // Auto
    Route::get('create_date_work', 'Cronjob\Create_Date_Controller@Create_Date_Work');
    Route::get('update_date_work', 'Cronjob\Update_Date_Controller@Update_Date_Work');
    Route::get('create_special_day', 'Cronjob\Create_Special_Day_Controller@Create_Special_Day');
    Route::get('update_money_work', 'Cronjob\Update_Money_Date_Controller@Update_Money_Work');
    Route::get('snapshot_month', 'Cronjob\Snapshot_Controller@SnapShot_Month');
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