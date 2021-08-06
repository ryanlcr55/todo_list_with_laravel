<?php

use Illuminate\Support\Facades\Route;

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

Route::namespace('Todo')
    ->middleware(['api', 'auth:api'])
    ->prefix('todos')
    ->group(function () {
       Route::get('/', 'GetByUser');
    });

Route::namespace('Todo')
    ->middleware(['api', 'auth:api'])
    ->prefix('todo')
    ->group(function () {
//        Route::get('/{todoId}', 'REPLACE_WITH_YOUR_CLASS');
        Route::post('/', 'Create');
        Route::put('/{todoId}', 'Update');
//        Route::delete('/{todoId}', 'REPLACE_WITH_YOUR_CLASS');
//
        Route::post('/{todoId}/item', 'Item\CreateOrUpdateItem');
        Route::put('/{todoId}/item/{itemId}', 'Item\CreateOrUpdateItem');
//        Route::delete('/{todoId}/item/{itemId}', 'REPLACE_WITH_YOUR_CLASS');
    });

Route::namespace('Auth')
    ->middleware([])
    ->prefix('auth')
    ->group(function () {
        Route::post('login', 'Login');
    });

Route::namespace('Auth')
    ->middleware(['api', 'auth:api'])
    ->prefix('auth')
    ->group(function () {
        Route::post('refresh', 'TokenFresh');
        Route::get('me', 'GetMe');
    });
