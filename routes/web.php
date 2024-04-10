<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;

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

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/publish', [AdminController::class, 'publish'])->name('publish');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Admin index
Route::get('/admin', [AdminController::class, 'index'])->name('AdminHome')->middleware('multiauth');
// Admin store
Route::get('/publish', [AdminController::class, 'publish'])->name('publish')->middleware('multiauth');
// Admin delete
// Admin show

// Student index
Route::get('/student', [HomeController::class, 'studex']);

// Student show
