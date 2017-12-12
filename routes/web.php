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

Route::get('/', function () {
    return view('home');
});

Route::get('/auth','AuthController@landing');
Route::get('/privacy-policy',function(){
	return view('privacy');
});

Route::post('/generate/image','AuthController@generateImage');
Route::post('/logout','AuthController@logout');
