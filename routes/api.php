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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('tasks', 'TaskController');

Route::apiResource('boards', 'BoardController');

Route::apiResource('columns', 'ColumnController');

Route::apiResource('cards', 'CardController');

Route::post('cards/update', 'CardController@updateMany');

Route::post('columns/positions/{boardId}', 'ColumnController@positions');