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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => 'true']);

Route::get('community/{channel?}', [App\Http\Controllers\CommunityLinkController::class, 'index'])->name('community');

Route::group(['middleware' => 'verified'], function () {
    /*
     * Rutas a verificar
     */
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    
    // Rutas del community
    Route::post('community', [App\Http\Controllers\CommunityLinkController::class, 'store']);
    Route::post('votes/{link}', [App\Http\Controllers\CommunityLinkUserController::class, 'store']);
    //Route::get('community', [App\Http\Controllers\CommunityLinkController::class, 'index']);
});