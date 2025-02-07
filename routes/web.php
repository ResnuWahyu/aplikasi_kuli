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
    return view('utama');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/artikel', function () {
    return view('artikel');
})->name('artikel');

// Route::middleware(['auth:sanctum', 'verified'])->get('/kuli/ajukandiri', function () {
//     return view('kuli.ajukandiri.index');
// })->name('kuli1');

// Route::middleware(['auth:sanctum', 'verified'])->get('/kuli/cariproyek', function () {
//     return view('kuli.cariproyek.index');
// })->name('kuli2');

Route::group(['middleware' => 'auth'], function () {
    // Route::group(['middleware' => 'role:admin', 'prefix' => 'admin', 'as' => 'admin.'], function() {
    //     Route::resource('lessons', \App\Http\Controllers\Students\LessonController::class);
    // });

    Route::group(['middleware' => 'role:kuli', 'prefix' => 'kuli', 'as' => 'kuli.'], function () {
        Route::resource('ajukandiri', \App\Http\Controllers\Kuli\AjukanDiriController::class);
    });

    Route::group(['middleware' => 'role:kuli', 'prefix' => 'kuli', 'as' => 'kuli.'], function () {
        Route::resource('cariproyek', \App\Http\Controllers\Kuli\CariProyekController::class);
    });

    Route::group(['middleware' => 'role:mandor', 'prefix' => 'mandor', 'as' => 'mandor.'], function () {
        Route::resource('carikuli', \App\Http\Controllers\Mandor\CariKuliController::class);
    });

    Route::group(['middleware' => 'role:mandor', 'prefix' => 'mandor', 'as' => 'mandor.'], function () {
        Route::resource('pasangproyek', \App\Http\Controllers\Mandor\PasangProyekController::class);
    });


    // Route::group(['middleware' => 'role:mandor', 'prefix' => 'mandor', 'as' => 'mandor.'], function() {
    //     Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
    // });
});
