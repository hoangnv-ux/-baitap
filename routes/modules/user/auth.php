<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserAuthController;
use GuzzleHttp\Middleware;

Route::prefix('user/auth')->group(function () {
    Route::get('login', function () {
        return view('user.auth.login');
    })->middleware('auth:user,redirect');

    Route::post('login', [UserAuthController::class, 'login'])->name('user.login');


});
