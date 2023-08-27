<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\DashboardController;
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

Route::get('/', [HomeController::class, 'index'])->name('index');

//register
Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('prosesregister', [AuthController::class, 'prosesregister'])->name('prosesregister');

//login
Route::post('proseslogin', [AuthController::class, 'proseslogin'])->name('proseslogin');

//setelah berhasil login
Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');
Route::get('dashboard/buku', [DashboardController::class, 'databuku'])->name('buku')->middleware('auth');
Route::get('dashboard/buku/tambah', [DashboardController::class, 'tambahbuku'])->name('tambahbuku')->middleware('auth');
Route::post('dashboard/buku/simpanbuku', [DashboardController::class, 'store'])->name('simpanbuku')->middleware('auth');
Route::post('dashboard/buku/update', [DashboardController::class, 'update'])->name('update')->middleware('auth');
Route::get('dashboard/buku/ubah/{id}', [DashboardController::class, 'ubah'])->name('ubah')->middleware('auth');
Route::get('dashboard/buku/hapus/{id}', [DashboardController::class, 'hapus'])->name('hapus')->middleware('auth');
//logout
Route::get('logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('blog', [BlogController::class, 'index']);
Route::get('blog/{nama}', [BlogController::class, 'getNama']);

Route::get('pendaftaran', [BlogController::class, 'pendaftaran']);
Route::post('pendaftaran/proses', [BlogController::class, 'proses']);
