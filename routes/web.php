<?php

use App\Http\Controllers\HomeController;
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

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/checkIfEligible', [HomeController::class, 'checkIfEligible'])->name('home.check-eligible');
Route::post('/submitSubmission', [HomeController::class, 'submitSubmission'])->name('home.submit-submission');
