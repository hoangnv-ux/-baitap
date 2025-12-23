<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;


Route::prefix('admin/auth')->group(function () {
    Route::get('/login', function () {
        return view('admin.auth.login');
    })->name('admin.login');

    Route::middleware(['auth:admin'])->group(function () {

    });
});
