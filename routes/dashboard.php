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

Route::get('/login', function () {
    return view('dashboard.auth.login');
})->name('dashboard.login');

Route::post('/login','AuthController@login')->name('dashboard.login.post');


Route::get('/signup', 'AuthController@create')->name('dashboard.create.admin');

Route::post('/signup','AuthController@store')->name('dashboard.store');


//home page for all user 
Route::get('/', function () {
    return view('dashboard.home');
})->name('dashboard.home');


// dashboard for admin only
Route::middleware(['adminAuth'])->group(function () {
    Route::any('/admin','HomeController@index')->name('dashboard.index');  
});

