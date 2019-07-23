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

	Route::get('/','HomeController@index')->name('index');

	Route::resource('assets', 'AssetController')->except(['edit','show','update']);

	Route::get('assets/type/{type?}','AssetController@type')->name('assets.type');

	Route::post('assets/changeStatus','AssetController@changeStatus')->name('assets.changeStatus');

	Route::get('av/autocomplete','AlphaVantageController@autocomplete')->name('alphaVantage.autocomplete');
	
	Route::resource('signals', 'SignalController')->only(['update']);

	Route::get('signals/type/{type?}','SignalController@type')->name('signals.type');

	Route::resource('scanners', 'ScannerController')->except(['index','show']);

	Route::get('scanners/type/{type?}','ScannerController@type')->name('scanners.type');

	Route::patch('scanners/updateSettings/{scanner}','ScannerController@updateSettings')->name('scanners.updateSettings');

	Route::patch('scanners/updateStatus/{scanner}','ScannerController@updateStatus')->name('scanners.updateStatus');

	Route::post('scanners/detachStrategy','ScannerController@detachStrategy')->name('scanners.detachStrategy');

	Route::post('scanners/attachStrategy','ScannerController@attachStrategy')->name('scanners.attachStrategy');

	Route::middleware(['auth', 'on'])->group(function () {

		Route::get('scanners/apply/{scanner}','ScannerController@apply')->name('scanners.apply');

		Route::get('scanners/{scanner}','ScannerController@show')->name('scanners.show');

	});
	
	Route::resource('settings', 'SettingController')->only(['index','update']);

	/*
	Route::resource('indicators', 'IndicatorController')->only(['index','edit','update']);

	Route::post('indicators/changeStatus','IndicatorController@changeStatus')->name('indicators.changeStatus');
	*/
		
});

