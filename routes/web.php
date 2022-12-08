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
Route::get('/good/{good}', [App\Http\Controllers\GoodController::class, 'show']);
Route::group(['middleware' => 'verified'], function () {
    Route::post('/good/{good}/review/store', [App\Http\Controllers\ReviewController::class, 'store']);
});
Route::get('/goods', [App\Http\Controllers\GoodController::class, 'index']);
Route::get('/user/{user}', [App\Http\Controllers\UserController::class, 'show']);
Route::get('/user/{user}/edit', [App\Http\Controllers\UserController::class, 'edit']);
Route::patch('/user/{user}/update', [App\Http\Controllers\UserController::class, 'update']);
Route::delete('/user/{user}/delete', [App\Http\Controllers\UserController::class, 'delete']);
Route::get('/admin', function () {
   return view('admin.index');
});
