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

Route::get('/', function () {
    return view('welcome');
});

Route::get('jobs', 'JobsController@index');
Route::get('jobs/view/{id}', 'JobsController@view');
Route::get('jobs/create', 'JobsController@create');
Route::post('jobs/save', 'JobsController@save');
Route::get('jobs/edit/{id}', 'JobsController@edit');
Route::post('jobs/update', 'JobsController@update');
Route::get('jobs/notspam/{id}', 'JobsController@notspam');
Route::get('jobs/spam/{id}', 'JobsController@spam');

Route::get('jobs/combined', 'JobsController@combined');
