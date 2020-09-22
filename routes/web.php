<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', 	['as' => 'login', 'uses' => 'App\Http\Controllers\LoginController@showLogin']);
Route::get('login',	['as' => 'login', 'uses' => 'App\Http\Controllers\LoginController@showLogin']);
Route::post('login',['as' => 'login', 'uses' => 'App\Http\Controllers\LoginController@doLogin']);

Route::get('logout', ['as' => 'logout', 'uses' => 'App\Http\Controllers\LoginController@doLogout']);

Route::resource('/userData',UserController::class, ['except' => []]);
Route::post('viewUsers',['as' => 'viewUsers','uses' => 'App\Http\Controllers\UserController@viewUsers']);

Route::get('dashboard',['as' => 'dashboard','uses' => 'App\Http\Controllers\UserController@dashboard']);