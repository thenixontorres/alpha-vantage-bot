<?php 

Route::get('/','HomeController@index')->name('index');

Route::resource('keys', 'KeyController');

Route::resource('users', 'UserController');

Route::resource('strategies', 'StrategyController')->only(['index','update']);

Route::resource('settings', 'SettingController')->only(['index','update']);

Route::resource('signals', 'SignalController')->only(['update', 'show']);

Route::get('signals/logs/{date?}/{type?}','SignalController@logs')->name('signals.logs');

Route::get('signals/index/{type?}','SignalController@index')->name('signals.index');


Route::resource('scanners', 'ScannerController')->except(['index','show']);

Route::get('scanners/index/{type?}','ScannerController@index')->name('scanners.index');

Route::patch('scanners/updateSettings/{scanner}','ScannerController@updateSettings')->name('scanners.updateSettings');

Route::patch('scanners/updateStatus/{scanner}','ScannerController@updateStatus')->name('scanners.updateStatus');

Route::patch('scanners/updatePool/{scanner}','ScannerController@updatePool')->name('scanners.updatePool');

Route::patch('scanners/updateEmail/{scanner}','ScannerController@updateEmail')->name('scanners.updateEmail');

Route::post('scanners/detachStrategy','ScannerController@detachStrategy')->name('scanners.detachStrategy');

Route::post('scanners/attachStrategy','ScannerController@attachStrategy')->name('scanners.attachStrategy');

Route::get('scanners/apply/{scanner}','ScannerController@apply')->name('scanners.apply');

Route::get('scanners/{scanner}','ScannerController@show')->name('scanners.show');

Route::resource('assets', 'AssetController')->except(['edit','show','update']);

Route::get('assets/index/{type?}','AssetController@index')->name('assets.index');

Route::post('assets/changeStatus','AssetController@changeStatus')->name('assets.changeStatus');

Route::get('av/autocomplete','AlphaVantageController@autocomplete')->name('alphaVantage.autocomplete');