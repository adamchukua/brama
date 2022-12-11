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

Auth::routes(['verify' => true]);

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('/guarantee', function (){
   return view('guarantee');
});
Route::get('/delivery', function (){
    return view('delivery');
});

Route::get('/goods', [App\Http\Controllers\GoodController::class, 'index']);
Route::get('/admin', [App\Http\Controllers\GoodController::class, 'index']);

Route::get('/good/{good}', [App\Http\Controllers\GoodController::class, 'show']);
Route::group(['middleware' => 'verified'], function () {
    Route::post('/good/{good}/review/store', [App\Http\Controllers\ReviewController::class, 'store']);
});
Route::delete('/good/{good}/delete', [App\Http\Controllers\GoodController::class, 'delete']);
Route::get('/good/{good}/edit', [App\Http\Controllers\GoodController::class, 'edit']);
Route::patch('/good/{good}/update', [App\Http\Controllers\GoodController::class, 'update']);
Route::get('/good/{good}/characteristics', [App\Http\Controllers\CharacteristicController::class, 'index']);
Route::post('/good/{good}/characteristic/store', [App\Http\Controllers\CharacteristicController::class, 'store']);
Route::get('/good/{good}/characteristic/{characteristic}/edit', [App\Http\Controllers\CharacteristicController::class, 'edit']);
Route::patch('/good/{good}/characteristic/{characteristic}/update', [App\Http\Controllers\CharacteristicController::class, 'update']);
Route::delete('/characteristic/{characteristic}/delete', [App\Http\Controllers\CharacteristicController::class, 'delete']);

Route::get('/user/{user}', [App\Http\Controllers\UserController::class, 'show']);
Route::get('/user/{user}/edit', [App\Http\Controllers\UserController::class, 'edit']);
Route::patch('/user/{user}/update', [App\Http\Controllers\UserController::class, 'update']);
Route::delete('/user/{user}/delete', [App\Http\Controllers\UserController::class, 'delete']);
Route::get('/user/{user}/reviews', [App\Http\Controllers\ReviewController::class, 'show']);

Route::get('/reviews', [App\Http\Controllers\ReviewController::class, 'index']);
Route::get('/review/{review}/edit', [App\Http\Controllers\ReviewController::class, 'edit']);
Route::patch('/review/{review}/update', [App\Http\Controllers\ReviewController::class, 'update']);
Route::delete('/review/{review}/delete', [App\Http\Controllers\ReviewController::class, 'delete']);
