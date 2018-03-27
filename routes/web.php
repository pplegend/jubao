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
Route::get('pz_list/{type}', 'PzController@index');


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
	Route::get('admin/audit', 'AdminAuditController@auditlist')->name('audit');
	Route::get('admin', 'AdminAuditController@auditlist');
	Route::get('admin/notaudit', 'AdminAuditController@notauditlist')->name('notaudit');

	//权威号码路由
	Route::get('admin/phone', 'AdminPhoneController@create')->name('phone.create');
	Route::get('admin/phones/{phone}', 'AdminPhoneController@edit')->name('phone.edit');
	Route::get('admin/phones/aduit/{id}', 'AdminPhoneController@audit')->name('phone.audit');
	Route::get('admin/phones/notaduit/{id}', 'AdminPhoneController@notaudit')->name('phone.notaudit');
	Route::post('admin/phones/{id}', 'AdminPhoneController@update')->name('phone.update');
	Route::post('admin/phone', 'AdminPhoneController@store')->name('phone.store');

	//骗子号码，微信等路由
	Route::get('admin/pzs/audit/{id}', 'PzController@audit')->name('pz.audit');
	Route::get('admin/pzs/notaudit/{id}', 'PzController@notaudit')->name('pz.notaudit');
	Route::get('admin/pzs/{pz}', 'PzController@edit')->name('pz.edit');
	Route::post('admin/pzs/{id}', 'PzController@update')->name('pz.update');

	//还没使用到
	Route::get('admin/qq', 'QqController@create')->name('qq.create');
	Route::post('admin/qq', 'QqController@store')->name('qq.store');
	Route::get('admin/data', 'AdminDataController@index');
	//首页参考 https://adminlte.io/themes/AdminLTE/index2.html
});



