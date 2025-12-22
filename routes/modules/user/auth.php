<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserAuthController;
use App\Http\Controllers\User\PostController;
Route::prefix('user/auth')->group(function () {
    Route::get('login', function () {
        return view('user.auth.login');
    })->middleware('redict.if.login:user')->name('user.login');
    Route::post('login', [UserAuthController::class, 'login'])->name('user.login');

    Route::middleware(['auth:user'])->group(function () {
        Route::post('logout', [UserAuthController::class, 'logout'])->name('user.logout');

        Route::get('/listpost', [PostController::class, 'index'])->name('user.listpost');

        Route::get('/addpost',[PostController::class,'create'])->name('user.create');
        Route::post('/store',[PostController::class,'store'])->name('user.post.store');

        Route::get('/edit/{post}', [PostController::class, 'edit'])->name('user.post.edit');
        Route::put('/update/{post}', [PostController::class, 'update'])->name('user.post.update');

        Route::delete('/destroy/{post}',[PostController::class,'destroy'])->name('user.post.destroy');
    });
});
