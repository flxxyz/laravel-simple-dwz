<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'IndexController@index');

Route::get('/{param}', 'IndexController@uri');

Route::prefix('top')->get('new', 'TopController@new');
Route::prefix('top')->get('click', 'TopController@click');
Route::prefix('top')->get('show', 'TopController@show');


Route::prefix('api')
    ->any('produce', 'ApiController@produce')
    ->middleware('api');
Route::prefix('api')
    ->any('new', 'ApiController@new')
    ->middleware('api');
Route::prefix('api')
    ->any('click', 'ApiController@click')
    ->middleware('api');
Route::prefix('api')
    ->any('show', 'ApiController@show')
    ->middleware('api');