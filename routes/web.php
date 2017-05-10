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

Route::get('admin', function () {
    return view('admin/admin_template');
});

Route::group(['namespace' => 'Admin'], function () {
	// Controllers Within The "App\Http\Controllers\Admin" Namespace
	Route::get('admin/test', 'AdminTestController@index');
});