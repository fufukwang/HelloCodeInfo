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
    return view('welcome');
});
Route::post('/contactus', 'HelloCodeController@ContactUs');



Route::group(['domain' => 'www.hellocode.info'], function() {
	Route::post('/deploy/hellocode', 'DeployController@HelloCodeInfo');	
});

Route::group(['domain' => 'funee.hellocode.info'], function() {
	Route::get('/', 'FuneeController@index');
	Route::get('/getRssUrl','FuneeController@getRssUrl');
});