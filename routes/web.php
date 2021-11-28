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


Route::namespace('Guests')->name('guests.')->group(function() {
    Route::get('/', 'HomeController@index')->name('home');

    Route::get('/contact', 'HomeController@createContactForm')->name('contact');
    Route::post('/contact', 'HomeController@contactFormHandler')->name('contact.send');
    Route::get('/thanks', 'HomeController@contactFormEnder')->name('thanks');
});

// Adds the email routes to 'Auth::routes()';
Auth::routes(['verify' => true]);

Route::middleware('auth') // using auth middleware to show routes only if user is authenticated
    ->namespace("Admin") //namespace is the folder name
    ->prefix('Admin') //prefix is for the uri calls
    ->name('admin.') //name is to call them (prefix)
    ->group(function(){
        Route::get('/', 'HomeController@index')->name('home');
        Route::resource('posts', PostController::class);

        // Route::resource('emails', EmailController::class)->except(["edit", "update"]);
});

// all the routes that start and end for any letter will be redirected to the guest.home if not stated otherwise
Route::get("{any?}", function(){
    return view('guests.home');
})->where("any", ".*");