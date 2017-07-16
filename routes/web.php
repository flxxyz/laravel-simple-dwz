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

Route::prefix('top')->get('new', 'TopController@new');
Route::prefix('top')->get('click', 'TopController@click');
Route::prefix('top')->get('show', 'TopController@show');


Route::prefix('api')
    ->any('produce', 'ApiController@produce')
    ->middleware('api');
Route::prefix('api/top')
    ->any('new', 'ApiController@new')
    ->middleware('api');
Route::prefix('api/top')
    ->any('click', 'ApiController@click')
    ->middleware('api');
Route::prefix('api/top')
    ->any('show', 'ApiController@show')
    ->middleware('api');

Route::prefix('hentai')->any('login', 'PublicController@login');
Route::prefix('hentai')->any('logout', 'PublicController@logout');
Route::prefix('hentai')->get('jump', 'PublicController@jump');

Route::get('hentai', 'AdminController@index');
Route::prefix('hentai')->get('index', 'AdminController@index');

// 每条短网址对应链接
Route::get('/{param}', 'IndexController@uri');