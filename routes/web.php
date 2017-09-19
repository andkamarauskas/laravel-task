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

Route::get('/map', function(){

  $latitudeFrom = 54.8374570;
  $longitudeFrom = 25.2619090;
  $latitudeTo = 54.6883100;
  $longitudeTo = 25.2612820;
  $earthRadius = 6371000;

  // convert from degrees to radians
  $latFrom = deg2rad($latitudeFrom);
  $lonFrom = deg2rad($longitudeFrom);
  $latTo = deg2rad($latitudeTo);
  $lonTo = deg2rad($longitudeTo);

  $latDelta = $latTo - $latFrom;
  $lonDelta = $lonTo - $lonFrom;

  $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) + cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
  $distance = $angle * $earthRadius;
  echo $distance;

});
