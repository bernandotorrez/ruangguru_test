<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
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

// Guest
Route::middleware(['guestSession'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home.index');
    Route::get('/check-submission', [HomeController::class, 'index'])->name('home.check-submission');
});

Route::get('/check-eligible', [HomeController::class, 'checkIfEligible'])->name('home.check-eligible');
Route::post('/submitSubmission', [HomeController::class, 'submitSubmission'])->name('home.submit-submission');

// Login
Route::prefix('login')->group(function () {
    Route::get('/', [LoginController::class, 'index'])->name('login.index');
    Route::post('/login', [LoginController::class, 'login'])->name('login.login');
    Route::get('/logout', [LoginController::class, 'logout'])->name('login.logout');
});


// Admin
Route::prefix('admin')->group(function () {
    Route::middleware(['adminSession'])->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/logout', [AdminController::class]);
    });
});

