<?php

Route::get('resetDB', 'Backoffice\HomeController@resetDB')->name('home.resetDB');

/*AUTH ROUTES*/

Route::get('login', 'Auth\LoginController@showLoginForm')->name('auth.login.show');

Route::post('login', 'Auth\LoginController@login')->name('auth.login');

Route::post('logout', 'Auth\LoginController@logout')->name('auth.logout');

/*FRONTOFFICE ROUTES*/
Route::get('/','Auth\LoginController@showLoginForm')->name('frontoffice.index');

/*BACKOFFICE ROUTES*/
Route::namespace('Backoffice')->name('backoffice.')->prefix('backoffice')->middleware(['auth'])->group(function () {

	require (__DIR__ . '/backoffice.php');

});

/*ADMIN ROUTES*/
/*BACKOFFICE ROUTES*/
Route::namespace('Admin')->name('admin.')->prefix('admin')->middleware(['auth','admin'])->group(function () {

	require (__DIR__ . '/admin.php');
	
});

