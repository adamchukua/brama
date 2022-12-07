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

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('/good/{good}', [App\Http\Controllers\GoodController::class, 'show']);
Route::group(['middleware' => 'verified'], function () {
    Route::post('/good/{good}/review/store', [App\Http\Controllers\ReviewController::class, 'store']);
});
Route::get('/goods', [App\Http\Controllers\GoodController::class, 'index']);
