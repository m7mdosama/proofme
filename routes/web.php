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

use App\Role;


Auth::routes();

Route::get('/',function (){  return view('home'); })->name('home');

Route::group(['prefix' => 'dashboard'], function () {
    Route::get('/', 'DashboardController@index')->name('dashboard')->middleware('role:1-2-3-4');
    Route::post('/upload', 'DashboardController@uploadDesign')->name('uploadDesign')->middleware('role:3');
});

Route::group(['middleware' => ['role:1-2-3'], 'prefix' => 'editor'], function () {
    Route::get('/{id}', 'EditorController@index')->name('editor');
    Route::get('/accept/{id}', 'EditorController@accept')->name('editor.accept');
    Route::post('/addproofer', 'EditorController@addProofer')->name('addProofer');
    Route::post('/addComment', 'EditorController@addComment')->name('addComment');
});

Route::group(['middleware' => ['role:1'], 'prefix' => 'admin'],function () {
    Route::get('/','AdminController@index')->name('admin');
    Route::post('/','AdminController@save')->name('adminSave');
});
