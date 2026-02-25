<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ReportController;

Route::get('/', [BookController::class, 'lihatBuku'])->name('books');

Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::get('/register', [LoginController::class, 'showRegister'])->name('register');
Route::post('/register', [LoginController::class, 'register']);

Route::post('/logout', [LoginController::class, 'logout']);

Route::middleware(['auth', 'is_user'])->group(function () {
    Route::get('/dashboard', [BookController::class, 'index'])->name('dashboard');
    Route::get('/pinjam-buku/{buku_id}', [BookController::class, 'showPinjamPage'])->name('pinjam-page');
    Route::post('/pinjam/{buku_id}', [BookController::class, 'pinjam'])->name('pinjam');
    Route::post('/kembalikan/{pinjaman_id}', [BookController::class, 'kembalikan'])->name('kembalikan');
    Route::get('/my-pinjaman', [BookController::class, 'myPinjaman'])->name('my.pinjaman');
    Route::post('/review', [BookController::class, 'submitReview'])->name('submit.review');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

// Admin Routes
Route::middleware(['auth', 'is_admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // Manage Buku
    Route::get('/buku', [AdminController::class, 'bukuIndex'])->name('admin.buku.index');
    Route::get('/buku/create', [AdminController::class, 'bukuCreate'])->name('admin.buku.create');
    Route::post('/buku', [AdminController::class, 'bukuStore'])->name('admin.buku.store');
    Route::get('/buku/{id}/edit', [AdminController::class, 'bukuEdit'])->name('admin.buku.edit');
    Route::put('/buku/{id}', [AdminController::class, 'bukuUpdate'])->name('admin.buku.update');
    Route::delete('/buku/{id}', [AdminController::class, 'bukuDestroy'])->name('admin.buku.destroy');
    
    // Manage Peminjaman
    Route::get('/pinjaman', [AdminController::class, 'pinjamanIndex'])->name('admin.pinjaman.index');
    Route::get('/pinjaman/{id}', [AdminController::class, 'pinjamanDetail'])->name('admin.pinjaman.detail');
    Route::post('/pinjaman/{id}/kembalikan', [AdminController::class, 'pinjamanKembalikan'])->name('admin.pinjaman.kembalikan');
    
    // Manage User
    Route::get('/user', [AdminController::class, 'userIndex'])->name('admin.user.index');
    Route::get('/user/create', [AdminController::class, 'userCreate'])->name('admin.user.create');
    Route::post('/user', [AdminController::class, 'userStore'])->name('admin.user.store');
    Route::get('/user/{id}', [AdminController::class, 'userDetail'])->name('admin.user.detail');
    Route::delete('/user/{id}', [AdminController::class, 'userDestroy'])->name('admin.user.destroy');
    
    // Manage Admin
    Route::get('/admin', [AdminController::class, 'adminIndex'])->name('admin.admin.index');
    Route::get('/admin/create', [AdminController::class, 'adminCreate'])->name('admin.admin.create');
    Route::post('/admin', [AdminController::class, 'adminStore'])->name('admin.admin.store');
    Route::delete('/admin/{id}', [AdminController::class, 'adminDestroy'])->name('admin.admin.destroy');
    
    // Manage Kategori
    Route::get('/kategori', [AdminController::class, 'kategoriIndex'])->name('admin.kategori.index');
    Route::get('/kategori/create', [AdminController::class, 'kategoriCreate'])->name('admin.kategori.create');
    Route::post('/kategori', [AdminController::class, 'kategoriStore'])->name('admin.kategori.store');
    Route::get('/kategori/{id}/edit', [AdminController::class, 'kategoriEdit'])->name('admin.kategori.edit');
    Route::put('/kategori/{id}', [AdminController::class, 'kategoriUpdate'])->name('admin.kategori.update');
    Route::delete('/kategori/{id}', [AdminController::class, 'kategoriDestroy'])->name('admin.kategori.destroy');
    
    // Laporan
    Route::get('/laporan', [ReportController::class, 'index'])->name('report.index');
});
