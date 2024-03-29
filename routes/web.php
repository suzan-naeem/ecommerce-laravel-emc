<?php

use App\Http\Controllers\website\HomeController;
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


// Route::get('/', function () {
//     return view('website.home.home');
// })->name('dashboard.home');

Route::get('/',[HomeController::class,'index'])->name('dashboard.home');  


Route::get('lang/{locale}', function ($locale) {
    if (in_array($locale, config()->get('app.locales'))) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
})->name('lang');


