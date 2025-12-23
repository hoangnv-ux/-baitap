<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserAuthController;

Route::prefix('user/auth')->group(function (){
    Route::get('login', function() {
        return view('user.login');
    })->name('user.login');


});
