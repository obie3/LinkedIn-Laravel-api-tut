<?php

use Illuminate\Http\Request;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('polls', 'PollsController@index');
Route::get('poll/{id}', 'PollsController@show');
Route::post('polls', 'PollsController@store');
Route::put('poll/{poll}', 'PollsController@update');
Route::delete('poll/{poll}', 'PollsController@delete');
Route::any('error', 'PollsController@errors');

Route::apiResource('questions', 'QuestionsController');

Route::get('poll/{poll}/questions', 'PollsController@questions');

Route::get('files/get', 'FilesController@show');
Route::post('file/create', 'FilesController@store');





