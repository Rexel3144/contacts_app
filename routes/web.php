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

Route::get('/', 'ContactController@index');
Route::resource('contact','ContactController');
Route::post('/contact/{contact}/edit/part','ContactController@editPart');
//Route::get('/contact/create','ContactController@create');
//Route::post('/contact/store', ['uses' => 'ContactController@store', 'as'=>'contact.store']);

Route::get('/export/vCard/{contact}','ExportController@vCard');

Auth::routes();


