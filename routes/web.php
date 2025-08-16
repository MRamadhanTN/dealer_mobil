<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CicilanController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\Admin\MobilController;
use App\Http\Controllers\Admin\PaketController;
use App\Http\Controllers\Admin\PembelianController;
use App\Http\Controllers\Admin\PembeliController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/login', function () {
    return view('admin.pages.auth.login');
})->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->name('admin.login')->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout')->middleware('auth');

Route::get('/forgotpass', function () {
    return view('admin.pages.auth.forgot_pass');
})->name('forgot')->middleware('guest');

Route::post('/forgot-pass', [AuthController::class, 'forgotPassword'])
    ->name('admin.forgot')
    ->middleware('guest');

// Forgot Password
Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('admin.forgot.password');
Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('admin.forgot.password.post');

// Reset Password
Route::get('/reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');

Route::middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'dashboard'])->name('admin.app');

    Route::prefix('/master/mobil')->group(function() {
        Route::get('/', [MobilController::class, 'index'])->name('admin.mobil');
        Route::get('/create', [MobilController::class, 'create'])->name('admin.mobil.create');
        Route::post('/', [MobilController::class, 'store'])->name('admin.mobil.store');
        Route::get('/{id}', [MobilController::class, 'show'])->name('admin.mobil.show');
        Route::get('/{id}/edit', [MobilController::class, 'edit'])->name('admin.mobil.edit');
        Route::post('/{id}', [MobilController::class, 'update'])->name('admin.mobil.update');
        Route::delete('/{id}', [MobilController::class, 'delete'])->name('admin.mobil.delete');
    });

    Route::prefix('/master/paket')->group(function() {
        Route::get('/', [PaketController::class, 'index'])->name('admin.paket');
        Route::get('/create', [PaketController::class, 'create'])->name('admin.paket.create');
        Route::post('/', [PaketController::class, 'store'])->name('admin.paket.store');
        Route::get('/{id}', [PaketController::class, 'show'])->name('admin.paket.show');
        Route::get('/{id}/edit', [PaketController::class, 'edit'])->name('admin.paket.edit');
        Route::post('/{id}', [PaketController::class, 'update'])->name('admin.paket.update');
        Route::delete('/{id}', [PaketController::class, 'delete'])->name('admin.paket.delete');
    });


    Route::prefix('/pelanggan/pembeli')->group(function() {
        Route::get('/', [PembeliController::class, 'index'])->name('admin.pembeli');
        Route::get('/create', [PembeliController::class, 'create'])->name('admin.pembeli.create');
        Route::post('/', [PembeliController::class, 'store'])->name('admin.pembeli.store');
        Route::get('/{id}', [PembeliController::class, 'show'])->name('admin.pembeli.show');
        Route::get('/{id}/edit', [PembeliController::class, 'edit'])->name('admin.pembeli.edit');
        Route::post('/{id}', [PembeliController::class, 'update'])->name('admin.pembeli.update');
        Route::delete('/{id}', [PembeliController::class, 'delete'])->name('admin.pembeli.delete');
    });

    Route::prefix('/pelanggan/cicilan')->group(function() {
        Route::get('/', [CicilanController::class, 'index'])->name('admin.cicilan');
        Route::post('/{trx}/{id}', [CicilanController::class, 'update'])->name('admin.cicilan.update');
    });

    Route::prefix('/order')->group(function() {
        Route::get('/', [PembelianController::class, 'index'])->name('admin.pembelian');
        Route::get('/create', [PembelianController::class, 'create'])->name('admin.pembelian.create');
        Route::post('/', [PembelianController::class, 'store'])->name('admin.pembelian.store');
        Route::get('/{id}', [PembelianController::class, 'show'])->name('admin.pembelian.show');
        Route::get('/{id}/edit', [PembelianController::class, 'edit'])->name('admin.pembelian.edit');
        Route::post('/{id}', [PembelianController::class, 'update'])->name('admin.pembelian.update');
        Route::delete('/{id}', [PembelianController::class, 'delete'])->name('admin.pembelian.delete');
    });

    Route::get('/report', function () {
        return view('admin.pages.report.report');
    })->name('admin.report');
});