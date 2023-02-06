<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


// auth
Route::group(['namespace' => 'Auth'], function ($router) {
    Route::group(['prefix' => 'auth'], function ($router) {
        $router->pattern('userId', '[0-9]+');
//        Route::post('register', 'RegisterController@register')->name('auth.register');
        Route::post('/login', [\App\Http\Controllers\Api\Auth\LoginController::class, 'login'])->name('auth.login');
//        Route::get('logout/{userId}', 'LoginController@logout')->name('auth.logout');
    });
});

Route::group([
    'middleware' => ['auth:sanctum'],
], function ($router) {
    Route::post('/create', [\App\Http\Controllers\Api\QuoteController::class, 'create'])->name('create');
    Route::post('/update/{quote}', [\App\Http\Controllers\Api\QuoteController::class, 'update'])->name('update');
});

Route::group([
    'middleware' => ['api'],
], function ($router) {
    Route::get('/quotes', [\App\Http\Controllers\Api\QuoteController::class, 'getQuotes'])->name('quotes');
    Route::get('/quote/{id}', [\App\Http\Controllers\Api\QuoteController::class, 'getQuote'])->name('quote');
    Route::post('/send/{id}', [\App\Http\Controllers\Api\QuoteController::class, 'sendQuote'])->name('send');
});
