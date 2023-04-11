<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

if (version_compare(PHP_VERSION, '7.2.0', '>=')) {
    // Ignores notices and reports all other kinds... and warnings
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
    // error_reporting(E_ALL ^ E_WARNING); // Maybe this is enough
}


Route::get('/faqs', 'GeneralController@faqsIndex');
Route::get('/contactus', 'GeneralController@contactIndex');
Route::get('/', 'GeneralController@aboutIndex');
//Route::post('/contactus', 'GeneralController@contactUs');

//register/login users
Auth::routes();

//application
Route::get('/applications/create', 'ApplicationManagement\ApplicationController@create');
Route::post('/applications/store', 'ApplicationManagement\ApplicationController@store');

Route::get('/applications/nav/{participant}', 'ApplicationManagement\ApplicationController@nav')->name('nav');
Route::get('/applications/edit-zero/{participant}', 'ApplicationManagement\ApplicationController@edit_zero')->name('step_zero');
Route::put('/applications/update-zero/{participant}', 'ApplicationManagement\ApplicationController@update_zero');
Route::get('/applications/edit-one/{participant}', 'ApplicationManagement\ApplicationController@edit_one')->name('step_one');
Route::put('/applications/update-one/{participant}', 'ApplicationManagement\ApplicationController@update_one');
Route::get('/applications/edit-two/{participant}', 'ApplicationManagement\ApplicationController@edit_two')->name('step_two');
Route::put('/applications/update-two/{participant}', 'ApplicationManagement\ApplicationController@update_two');
Route::get('/applications/edit-three/{participant}', 'ApplicationManagement\ApplicationController@edit_three')->name('step_three');
Route::put('/applications/update-three/{participant}', 'ApplicationManagement\ApplicationController@update_three');
Route::get('/applications/edit-four/{participant}', 'ApplicationManagement\ApplicationController@edit_four')->name('step_four');
Route::put('/applications/update-four/{participant}', 'ApplicationManagement\ApplicationController@update_four');
Route::get('/applications/edit-five/{participant}', 'ApplicationManagement\ApplicationController@edit_five')->name('step_five');
Route::put('/applications/update-five/{participant}', 'ApplicationManagement\ApplicationController@update_five');

//participant
Route::get('/participants', 'ParticipantManagement\ParticipantController@index');
Route::get('/participants/create', 'ParticipantManagement\ParticipantController@create');
Route::post('/participants/store', 'ParticipantManagement\ParticipantController@store');
Route::get('/participants/profile/{participant}', 'ParticipantManagement\ParticipantController@showProfile');
Route::get('/participants/flyer/{participant}', 'ParticipantManagement\ParticipantController@showFlyer');
Route::get('/participants/ID/{participant}', 'ParticipantManagement\ParticipantController@showID');
Route::get('/participants/edit/{participant}', 'ParticipantManagement\ParticipantController@edit');
Route::put('/participants/update/{participant}', 'ParticipantManagement\ParticipantController@update');
Route::delete('/participants/delete/{participant}', 'ParticipantManagement\ParticipantController@delete');
Route::post('/participants/restore/{id}', 'ParticipantManagement\ParticipantController@restore');
//search
Route::get('/participants/search', 'ParticipantManagement\ParticipantController@search');
Route::post('/participants/search', 'ParticipantManagement\ParticipantController@search');
//PDF Download Link/Email Flyer
Route::get('/participants/showFlyerPDF/{participant}', 'ParticipantManagement\ParticipantController@showFlyerPDF');
Route::post('/participants/flyer/{participant}', 'ParticipantManagement\ParticipantController@emailFlyerPDF');
//Route::post('/participants/flyer/undo/{participant}/{id}', 'ParticipantManagement\ParticipantController@undoemailFlyerPDF');

//Route::get('/participants/showProfilePDF/{participant}', 'ParticipantManagement\ParticipantController@showProfilePDF'); //TOO MUCH MEMORY USED
Route::get('file/participants/{filename}', 'FileController@getFile')->where('filename', '^[^/]+$');


//roles
Route::get('/roles', 'RoleManagement\RoleController@index');
//Route::get('/roles/create', 'RoleManagement\RoleController@create');
Route::post('/roles/store', 'RoleManagement\RoleController@store');
//Route::get('/roles/{role}', 'RoleManagement\RoleController@show');
Route::get('/roles/edit/{role}', 'RoleManagement\RoleController@edit');
Route::put('/roles/update/{role}', 'RoleManagement\RoleController@update');
Route::delete('/roles/delete/{role}', 'RoleManagement\RoleController@delete');

//users
Route::get('/users', 'UserManagement\UserController@index');
//Route::get('/users/create', 'UserManagement\UserController@create');
Route::post('/users/store', 'UserManagement\UserController@store');
//Route::get('/users/{user}', 'UserManagement\UserController@show'); //maybe can add user specific details such as logins etc
Route::get('/users/edit/{user}', 'UserManagement\UserController@edit');
Route::get('/users/editpersonalinfo', 'UserManagement\UserController@editPersonalInfo');
Route::put('/users/update/{user}', 'UserManagement\UserController@update');
Route::put('/users/updatepersonalinfo', 'UserManagement\UserController@updatePersonalInfo');
Route::delete('/users/delete/{user}', 'UserManagement\UserController@delete');
Route::post('/users/restore/{id}', 'UserManagement\UserController@restore');
Route::get('/users/search', 'UserManagement\UserController@search');
Route::post('/users/search', 'UserManagement\UserController@search');

//emaillists
Route::get('/emaillists', 'EmailListManagement\EmailListController@index');
//Route::get('/emaillists/create', 'EmailListManagement\EmailListController@create');
Route::post('/emaillists/store', 'EmailListManagement\EmailListController@store');
Route::post('/emaillists/sendmail', 'EmailListManagement\EmailListController@sendmail');
//Route::get('/emaillists/show/{emaillist}', 'EmailListManagement\EmailListController@show');
Route::get('/emaillists/edit/{emaillist}', 'EmailListManagement\EmailListController@edit');
Route::put('/emaillists/update/{emaillist}', 'EmailListManagement\EmailListController@update');
Route::delete('/emaillists/delete/{emaillist}', 'EmailListManagement\EmailListController@delete');

//settings
Route::get('/settings', 'SettingManagement\SettingController@index');
//Route::get('/settings/create', 'SettingManagement\SettingController@create');
//Route::post('/settings/store', 'SettingManagement\SettingController@store');
//Route::get('/settings/{setting}', 'SettingManagement\SettingController@show');
Route::get('/settings/edit/{setting}', 'SettingManagement\SettingController@edit');
Route::put('/settings/update/{setting}', 'SettingManagement\SettingController@update');
Route::delete('/settings/delete/{setting}/{emaillist}', 'SettingManagement\SettingController@delete');

//logs
//By Rap2h
Route::get('/logs', 'LogController@index');

//Tutorial
Route::get('/tutorial', 'GeneralController@tutorialIndex');

Route::get('/sheriff', 'ParticipantManagement\ParticipantController@search');