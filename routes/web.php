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


    /** 
     * Ejercicio 1
     */
    // 1)
    Route::get('/A41-1-1/{id_1?}', function ($id_1 = null) {
        if(isset($id_1)) return view('A41_bien');
        return view('A41_mal');
    });
    // 2)
    Route::get('/A41-1-2/{id_1?}', function ($id_2 = 1) {
        if($id_2 == 1) return view('A41_bien');
        return view('A41_mal');
    });
    // 3)
    Route::post('/A41-1-3', function () {
        return view('A41_bien');
    });
    // 4)
    Route::match(['get', 'post'],'/A41-1-4/', function () {
        return view('A41_bien');
    });
    // 5)
    Route::get('/A41-1-5/{id_5}', function ($id_5 = 1) {
        return view('A41_bien');
    })->where('id_5', '[1-9]+');
    // 6)
    Route::get('/A41-1-6/{letras}/{numeros}', function ($letras, $numeros) {
        return view('A41_bien');
    })->where(['letras' => '[A-Za-z]+', 'numeros' => '[1-9]+']);
    
    /** 
     * Ejercicio 2
     */
    // 1)
    Route::get('/host', function () {
        return env('DB_HOST');
    });
    // 2)
    Route::get('/timezone', function() {
        return config('app.timezone');
    });

    /** 
     * Ejercicio 2
     */
    // 1)+
    Route::view('/inicio', 'home2');
    // 2)
    Route::get('/fecha', function(){
        $d = new DateTime;
        return view('fecha', [
            'day' => explode('-', explode('T', $d->format('c'))[0])[2],
            'month' => explode('-', explode('T', $d->format('c'))[0])[1], 
            'year' => explode('-', explode('T', $d->format('c'))[0])[0]
        ]);
    });
    // 3)
    Route::get('/fechacompact', function(){
        $d = new DateTime;
        $day = explode('-', explode('T', $d->format('c'))[0])[2];
        $month = explode('-', explode('T', $d->format('c'))[0])[1];
        $year = explode('-', explode('T', $d->format('c'))[0])[0];

        return view('fecha', compact('day', 'month', 'year'));
    });
    // 4)
    Route::get('/fechawith', function(){
        $d = new DateTime;
        return view('fecha', with($d, function($date){
            $values['day'] = explode('-', explode('T', $date->format('c'))[0])[2];
            $values['month'] = explode('-', explode('T', $date->format('c'))[0])[1];
            $values['year'] = explode('-', explode('T', $date->format('c'))[0])[0];
            return $values;
        }));
    });
    // 5-6)
    // Route::view('/404', '404');
});