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

Auth::routes();

Route::middleware(['auth'])->group(function(){
    Route::middleware(['isMr'])->prefix('mr')->name('mr.')->group(function(){
        Route::resources([
            'users' =>App\Http\Controllers\Mr\UserController::class,
            'trashed'=>App\Http\Controllers\Mr\UserRemoveController::class,
        ]);
    });

    Route::middleware(['isMrs'])->prefix('mrs')->name('mrs.')->group(function(){
        Route::resources([
            'users' =>App\Http\Controllers\Mrs\UserController::class,
            'trashed'=>App\Http\Controllers\Mrs\UserRemoveController::class,
        ]);

    });
    Route::middleware(['isMs'])->prefix('ms')->name('ms.')->group(function(){
        Route::resources([
            'users' =>App\Http\Controllers\Ms\UserController::class,
            'trashed'=>App\Http\Controllers\Ms\UserRemoveController::class,
        ]);
    });
    Route::resources([
        'password'=>App\Http\Controllers\PasswordController::class,
    ]);
});

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/store', [App\Http\Controllers\HomeController::class, 'store'])->name('home.store');
