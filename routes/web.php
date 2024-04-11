<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StudentController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/publish', [AdminController::class, 'publish'])->name('publish');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//temp
Route::get('delete/{id}', [HomeController::class, 'delete'])->name('delete');
Route::get('/view/{id}', [HomeController::class, 'view'])->name('view.doc');

// Admin Routes
//Route::get('/admin', [AdminController::class, 'index'])->name('AdminHome');
Route::get('/publish', [AdminController::class, 'publish'])->name('publish');
Route::post('/save', [AdminController::class, 'save'])->name('save');
//Route::get('delete', [AdminController::class, 'delete'])->name('delete')->middleware('multiauth');
//Route::get('/view', [AdminController::class, 'view'])->name('view')->middleware('multiauth');

// Student Route
Route::get('/', [StudentController::class, 'index'])->name('student.home');
Route::get('/read/{id}', [StudentController::class, 'view'])->name('student.read');
