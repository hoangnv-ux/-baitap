<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserAuthController;

Route::prefix('user/auth')->middleware('auth:user')->group(function (){
    Route::get('dashboard', function (){
        return view('user.dashboard');
    })->name('user.dashboard');
    Route::post('logout', [UserAuthController::class, 'logout'])->name('user.logout');
});
