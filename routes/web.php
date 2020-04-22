<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'Controller@home');
Route::get('/widget_remote_ajax/{page_uid}', 'Controller@widget_remote_ajax');
Route::get('/widget_local_submit/{page_uid}', 'Controller@widget_local_submit');
Route::get('/widget_local_ajax/{page_uid}', 'Controller@widget_local_ajax');

//Route::post('/api', 'ApiController@run');