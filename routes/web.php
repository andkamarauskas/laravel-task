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

use Cornford\Googlmapper\Facades\MapperFacade;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
	return view('auth.login');
});

Auth::routes();


Route::group(['middleware' => ['auth']], function() {	
	Route::get('/home', 'HomeController@index')->name('home');
	Route::get('/device/add', 'DeviceController@create')->name('device.add');
	Route::post('/device/store', 'DeviceController@store')->name('device.store');
});

