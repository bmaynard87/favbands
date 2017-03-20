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

//Band routes
Route::get('bands/{id}', 'BandsController@index');
Route::get('bands', 'BandsController@index');
Route::post('bands', 'BandsController@store');
Route::put('bands/{id}', 'BandsController@update');
Route::delete('bands/{id}', 'BandsController@destroy');

//Album Routes
Route::get('albums/band/{id}', 'AlbumsController@getAlbumsByBandId');
Route::get('albums/{id}', 'AlbumsController@index');
Route::get('albums', 'AlbumsController@index');
Route::post('albums', 'AlbumsController@store');
Route::put('albums/{id}', 'AlbumsController@update');
Route::delete('albums/{id}', 'AlbumsController@destroy');