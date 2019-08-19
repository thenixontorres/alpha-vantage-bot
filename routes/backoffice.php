<?php 

Route::get('/','HomeController@index')->name('index');

Route::resource('users', 'UserController')->only(['index','update']);

Route::resource('signals', 'SignalController')->only(['update']);

Route::get('signals/index/{type?}','SignalController@index')->name('signals.index');

Route::resource('scanners', 'ScannerController')->except(['index','show']);

Route::get('scanners/index/{type?}','ScannerController@index')->name('scanners.index');

Route::patch('scanners/updateSettings/{scanner}','ScannerController@updateSettings')->name('scanners.updateSettings');

Route::patch('scanners/updateStatus/{scanner}','ScannerController@updateStatus')->name('scanners.updateStatus');

Route::patch('scanners/updatePool/{scanner}','ScannerController@updatePool')->name('scanners.updatePool');

Route::patch('scanners/updateEmail/{scanner}','ScannerController@updateEmail')->name('scanners.updateEmail');

Route::post('scanners/detachStrategy','ScannerController@detachStrategy')->name('scanners.detachStrategy');

Route::post('scanners/attachStrategy','ScannerController@attachStrategy')->name('scanners.attachStrategy');

Route::middleware(['auth', 'on'])->group(function () {

	Route::get('scanners/apply/{scanner}','ScannerController@apply')->name('scanners.apply');

	Route::get('scanners/{scanner}','ScannerController@show')->name('scanners.show');

});