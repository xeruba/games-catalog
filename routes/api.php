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


/*SHOW*/
Route::get('games/{game_id}', 'GameController@show');

/*INDEX*/
Route::get('games', 'GameController@index');

/*INDEX*/
Route::get('genre/{genre_id}/games', 'GenreController@getGames');

/*STORE*/
Route::post('games', 'GameController@store');

/*UPDATE*/
Route::put('games/{game_id}', 'GameController@update');
Route::patch('games/{game_id}', 'GameController@update');

/*DELETE*/
Route::delete('games/{game_id}', 'GameController@destroy');