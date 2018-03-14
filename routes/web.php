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
   	Debugbar::info("info");
Debugbar::error('Error!');
Debugbar::warning('Watch out…');
Debugbar::addMessage('Another message', 'mylabel');
	 return view('welcome');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['namespace' => 'Admin'], function () {
	// Controllers Within The "App\Http\Controllers\Admin" Namespace
	Route::get('admin/audit', 'AdminAuditController@index')->name('aduit');
	Route::get('admin/test', 'AdminTestController@index');
	Route::get('admin/data', 'AdminDataController@index');
	Route::get('admin/phones', 'AdminPhoneController@index')->name('phones.index')->middleware('auth');
	Route::get('admin/phone', 'AdminPhoneController@create')->name('phone.create');
	Route::get('admin/phones/{phone}', 'AdminPhoneController@edit')->name('phone.edit');
	Route::get('admin/phones/aduit/{id}', 'AdminPhoneController@aduit')->name('phone.aduit');
	Route::get('admin/phones/notaduit/{id}', 'AdminPhoneController@notaduit')->name('phone.notaduit');
	Route::post('admin/phones/{id}', 'AdminPhoneController@update')->name('phone.update');
	Route::post('admin/phone', 'AdminPhoneController@store')->name('phone.store');


	
	//首页参考 https://adminlte.io/themes/AdminLTE/index2.html
});



