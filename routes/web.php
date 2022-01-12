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
Route::group(['middleware' => 'verified'], function () {
    /*
     * Rutas a verificar
     */
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    
    // Rutas del community
    Route::get('community', [App\Http\Controllers\CommunityLinkController::class, 'index'])->name('community');
    Route::post('community', [App\Http\Controllers\CommunityLinkController::class, 'store']);
});