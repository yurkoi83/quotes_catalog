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
    $quotes = \App\Models\Quote::all();
    return view('welcome', ['quotes' => $quotes]);
});

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group([
    'middleware' => ['web'],
], function ($router) {
    Route::get('/send/{quote}', [\App\Http\Controllers\Web\QuoteController::class, 'send'])->name('send');
});

Route::group([
    'middleware' => ['auth'],
], function ($router) {
    Route::get('/home', [\App\Http\Controllers\Web\HomeController::class, 'index'])->name('home');
    Route::post('/create', [\App\Http\Controllers\Web\HomeController::class, 'create'])->name('create');
    Route::get('/edit/{quote}', [\App\Http\Controllers\Web\HomeController::class, 'edit'])->name('edit');
    Route::put('/update/{quote}', [\App\Http\Controllers\Web\HomeController::class, 'update'])->name('update');
});
