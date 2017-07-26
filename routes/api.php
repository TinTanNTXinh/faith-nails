<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'v1', 'namespace' => 'Api'], function () {
    Route::group(['middleware' => []], function () {
        Route::post('/authentication', 'AuthController@postAuthentication');
    });

    // Co header la "Bearer + token" thi duoc vao
    Route::group(['middleware' => 'jwt.auth'], function () {
        Route::get('/authorization', 'AuthController@getAuthorization');

        /** MAIN **/
        // Position
        Route::group(['middleware' => 'position', 'prefix' => 'positions'], function () {
            Route::get('/', 'PositionController@getReadAll');
            Route::get('/search', 'PositionController@getSearchOne');
            Route::get('/{id}', 'PositionController@getReadOne');
            Route::post('/', 'PositionController@postCreateOne');
            Route::put('/', 'PositionController@putUpdateOne');
            Route::patch('/', 'PositionController@patchDeactivateOne');
            Route::delete('/{id}', 'PositionController@deleteDeleteOne');
        });

        // User
        Route::group(['middleware' => 'user', 'prefix' => 'users'], function () {
            Route::get('/', 'UserController@getReadAll');
            Route::get('/search', 'UserController@getSearchOne');
            Route::get('/{id}', 'UserController@getReadOne');
            Route::post('/', 'UserController@postCreateOne');
            Route::post('/change-password', 'UserController@postChangePassword');
            Route::put('/', 'UserController@putUpdateOne');
            Route::patch('/', 'UserController@patchDeactivateOne');
            Route::delete('/{id}', 'UserController@deleteDeleteOne');
        });

        // Category
        Route::group(['middleware' => 'category', 'prefix' => 'categories'], function () {
            Route::get('/', 'CategoryController@getReadAll');
            Route::get('/search', 'CategoryController@getSearchOne');
            Route::get('/{id}', 'CategoryController@getReadOne');
            Route::post('/', 'CategoryController@postCreateOne');
            Route::put('/', 'CategoryController@putUpdateOne');
            Route::patch('/', 'CategoryController@patchDeactivateOne');
            Route::delete('/{id}', 'CategoryController@deleteDeleteOne');
        });

        // Item
        Route::group(['middleware' => 'item', 'prefix' => 'items'], function () {
            Route::get('/', 'ItemController@getReadAll');
            Route::get('/search', 'ItemController@getSearchOne');
            Route::get('/{id}', 'ItemController@getReadOne');
            Route::post('/', 'ItemController@postCreateOne');
            Route::put('/', 'ItemController@putUpdateOne');
            Route::patch('/', 'ItemController@patchDeactivateOne');
            Route::delete('/{id}', 'ItemController@deleteDeleteOne');
        });



        // Customer
        Route::group(['middleware' => 'customer', 'prefix' => 'customers'], function () {
            Route::get('/', 'CustomerController@getReadAll');
            Route::get('/search', 'CustomerController@getSearchOne');
            Route::get('/{id}', 'CustomerController@getReadOne');
            Route::post('/', 'CustomerController@postCreateOne');
            Route::put('/', 'CustomerController@putUpdateOne');
            Route::patch('/', 'CustomerController@patchDeactivateOne');
            Route::delete('/{id}', 'CustomerController@deleteDeleteOne');
        });


        // Unit
        Route::group(['middleware' => 'unit', 'prefix' => 'units'], function () {
            Route::get('/', 'UnitController@getReadAll');
            Route::get('/search', 'UnitController@getSearchOne');
            Route::get('/{id}', 'UnitController@getReadOne');
            Route::post('/', 'UnitController@postCreateOne');
            Route::put('/', 'UnitController@putUpdateOne');
            Route::patch('/', 'UnitController@patchDeactivateOne');
            Route::delete('/{id}', 'UnitController@deleteDeleteOne');
        });

        // Product
        Route::group(['middleware' => 'product', 'prefix' => 'products'], function () {
            Route::get('/', 'ProductController@getReadAll');
            Route::get('/search', 'ProductController@getSearchOne');
            Route::get('/{id}', 'ProductController@getReadOne');
            Route::post('/', 'ProductController@postCreateOne');
            Route::put('/', 'ProductController@putUpdateOne');
            Route::patch('/', 'ProductController@patchDeactivateOne');
            Route::delete('/{id}', 'ProductController@deleteDeleteOne');
        });


        //
        Route::group(['middleware' => []], function () {

        });

    });
});


