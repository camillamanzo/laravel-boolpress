<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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


Route::get('/', 'Guests\HomeController@index')->name('guests.home');

Auth::routes();

Route::middleware('auth') // using auth middleware to show routes only if user is authenticated
    ->namespace("Admin") //namespace is the folder name
    ->prefix('Admin') //prefix is for the uri calls
    ->name('admin.') //name is to call them
    ->group(function(){
        Route::get('/', 'HomeController@index')->name('home');
        Route::resource('posts', PostController::class);
});

Route::get("{any?}", function(){
    return view('guests.home');
})->where("any", ".*");