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

//Route::get('/ir',function(){
//    //App\Role::create(['name'=>'User','description'=>'test 2']);
//
//    //$x = App\Role::find(4);
//    //if($x->delete())
//    //    echo "Good <br>";
//
//    //echo Role::all();
//
//    return view('welcome');
//});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

Route::get('/',function (){
    return view('welcome');
})->name('welcome');
Route::get('/home',function (){
    return view('home');
})->name('home');
//Route::get('/', 'DashboardController@index')->name('index');
Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
Route::post('/dashboard/upload', 'DashboardController@uploadDesign')->name('uploadDesign');

Route::get('/editor/{id}', 'EditorController@index')->name('editor');
Route::get('/editor/accept/{id}', 'EditorController@accept')->name('editor.accept');
Route::post('/editor/addproofer', 'EditorController@addProofer')->name('addProofer');
