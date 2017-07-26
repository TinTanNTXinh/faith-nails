<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::group(['middleware' => []], function () {

    Route::group(['prefix' => 'artisan'], function () {
        Route::get('reset', 'ArtisanController@getCommandReset');
    });

    Route::group(['prefix' => 'file'], function () {
        Route::get('import-export', 'TestController@getImportExport');
        Route::get('download/{type}', 'TestController@getDownload');
        Route::post('import', 'TestController@postImport');
    });

    Route::group(['prefix' => 'test'], function () {
        Route::get('test', 'TestController@index');
    });

     Route::any('/{slug}', function () {
         return File::get(public_path() . '/home/index.html');
     })->where('slug', '([A-z\d-\/_.]+)?');

//    Route::get('/{any}', function ($any) {
//        return File::get(public_path() . '/home/index.html');
//    })->where('any', '.*');
});

