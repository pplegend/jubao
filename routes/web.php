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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('pz/{id}', 'PzController@show')->name('pz.show');
Route::get('admin/pzs/{pz}', 'PzController@edit')->name('pz.edit');

Route::get('pz_phone', 'PzphoneController@index');
Route::get('pz_qq', 'QqController@index')->name('pz_qq.list');
Route::get('pz_email', 'EmailController@index')->name('pz_email.list');
Route::get('pz_weixin', 'WeixinController@index')->name('pz_weixin.list');
Route::get('pz_company', 'CompanyController@index')->name('pz_gs.list');
Route::get('woyaojubao', function () {
	return view('woyaojubao');
})->name('pz_jubao.show');

Route::post('search/{type}', 'HomeController@search')->name('search');
Route::post('woyaojubao', 'HomeController@woyaojubao')->name('woyaojubao');

Route::group(['namespace' => 'Admin'], function () {
	// Controllers Within The "App\Http\Controllers\Admin" Namespace
	Route::get('admin', 'AdminAuditController@index')->name('aduitlist');
	Route::get('admin/audit', 'AdminAuditController@aduit')->name('aduit');
	Route::get('admin/audit', 'AdminAuditController@notaduit')->name('notaduit');

	Route::get('admin/data', 'AdminDataController@index');
	Route::get('admin/phones', 'AdminPhoneController@index')->name('phones.index')->middleware('auth');
	Route::get('admin/phone', 'AdminPhoneController@create')->name('phone.create');
	Route::get('admin/phones/{phone}', 'AdminPhoneController@edit')->name('phone.edit');
	Route::get('admin/phones/aduit/{id}', 'AdminPhoneController@aduit')->name('phone.aduit');
	Route::get('admin/phones/notaduit/{id}', 'AdminPhoneController@notaduit')->name('phone.notaduit');
	Route::post('admin/phones/{id}', 'AdminPhoneController@update')->name('phone.update');
	Route::post('admin/phone', 'AdminPhoneController@store')->name('phone.store');

	Route::get('admin/qqs/aduit/{id}', 'QqController@aduit')->name('qq.aduit');
	Route::get('admin/qqs/notaduit/{id}', 'QqController@notaduit')->name('qq.notaduit');
	Route::get('admin/qq', 'QqController@create')->name('qq.create');
	Route::post('admin/qq', 'QqController@store')->name('qq.store');

	Route::post('admin/qqs/{id}', 'QqController@update')->name('qq.update');
	
	//首页参考 https://adminlte.io/themes/AdminLTE/index2.html
});



