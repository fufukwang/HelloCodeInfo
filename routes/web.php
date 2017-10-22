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
if(App::environment('local')) {
    $url = 'hello.dev';
}else if(App::environment('production')) {
    $url = 'hellocode.info';
}else {
    $url = '';
}


Route::get('/', function () {
    return view('welcome');
});
Route::post('/contactus', 'HelloCodeController@ContactUs');



Route::group(['domain' => 'www.'.$url], function() {
	Route::post('/deploy/hellocode', 'DeployController@HelloCodeInfo');	
});

Route::group(['domain' => 'funee.'.$url], function() {
	Route::get('/', 'FuneeController@index');
	Route::post('/getRssUrl','FuneeController@getRssUrl');
});



Route::group(['domain' => 'liebel.'.$url], function() {
	Route::post('/update.xml', 'LiebelController@grXml');	
});


Route::group(['domain' => 'fabric.'.$url], function() {
	Route::get('/', 'FabricController@home');	
});