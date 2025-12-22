<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;


Route::prefix('admin/auth')->group(function () {
    Route::get('/login', function () {
        return view('admin.auth.login');
    })->middleware('redict.loged.in:admin')->name('admin.login');

    Route::post('/login', [AdminAuthController::class,'login'])->name('admin.login');

    Route::middleware(['auth:admin'])->group(function () {
        Route::post('/logout',[AdminAuthController::class,'logout'])->name('admin.logout');
        Route::get('/me', function () {
            return view('admin.auth.me');
        })->name('admin.me');
    });
});
