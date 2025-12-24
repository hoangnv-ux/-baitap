<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserAuthController;


Route::prefix('user/auth')->group(function (){
    Route::get('login', function(){
        return view('user.login');
    })->middleware('auth:user,redirect')->name('user.login');

    Route::post('login',[UserAuthController::class, 'login'])->name('user.login');

    Route::middleware(['auth:user'])->group(function () {
        Route::post('logout', [UserAuthController::class, 'logout'])->name('user.logout');
    });
});

