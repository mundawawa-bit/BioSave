<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ApprovalController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminFaunaController;
use App\Http\Controllers\AdminFloraController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FaunaController;
use App\Http\Controllers\FloraController;
use App\Http\Controllers\UserHomeController;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\AboutSettingController;

/*
|--------------------------------------------------------------------------
| PUBLIC / GUEST ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/flora', [FloraController::class, 'index'])->name('flora.index');
Route::get('/flora/{flora}', [FloraController::class, 'show'])->name('flora.show');

Route::get('/fauna', [FaunaController::class, 'index'])->name('fauna.index');
Route::get('/fauna/{fauna}', [FaunaController::class, 'show'])->name('fauna.show');

Route::get('/about', [AboutUsController::class, 'about'])->name('about');

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.process');

    Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| USER ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->prefix('user')->name('user.')->group(function () {

    // HOME
     Route::get('/', [UserHomeController::class, 'index'])->name('home');

    // PROFILE
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');

    // --- FITUR PENGAJUAN (SUBMISSION) ---
    Route::get('/submission', [SubmissionController::class, 'index'])->name('submission.index');
    Route::get('/submission/create', [SubmissionController::class, 'create'])->name('submission.create');
    Route::post('/submission', [SubmissionController::class, 'store'])->name('submission.store');
    Route::get('/submission/{type}/{id}/edit', [SubmissionController::class, 'edit'])->name('submission.edit');
    Route::put('/submission/{type}/{id}', [SubmissionController::class, 'update'])->name('submission.update');
    Route::delete('/submission/{type}/{id}',[SubmissionController::class, 'destroy'])->name('submission.destroy');

});

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    // DASHBOARD
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    //Halaman Flora
    Route::resource('/flora', AdminFloraController::class);

    //Halaman Fauna
    Route::resource('/fauna', AdminFaunaController::class);

    //Halaman Approval
    Route::get('/approval', [ApprovalController::class, 'index'])->name('konfirmasiPengajuan.index');
    Route::patch('/approval/flora/{flora}', [ApprovalController::class, 'approveFlora'])->name('approval.approveFlora');
    Route::patch('/approval/fauna/{fauna}', [ApprovalController::class, 'approveFauna'])->name('approval.approveFauna');
    Route::patch('/admin/approval/flora/{flora}/reject',[ApprovalController::class, 'rejectFlora'])->name('approval.rejectFlora');
    Route::patch('/admin/approval/fauna/{fauna}/reject',[ApprovalController::class, 'rejectFauna'])->name('approval.rejectFauna');


    // USERS / DATA ANGGOTA
    Route::get('/users', [UserController::class, 'index'])->name('dataAnggota.index');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('dataAnggota.destroy');

    // ABOUT SETTING
    // Menampilkan Form Setting (Halaman Edit/Create gabungan)
    Route::get('/settings/about', [AboutSettingController::class, 'index'])->name('about.index');

    // Menyimpan Perubahan Data (Method PUT sesuai form)
    Route::put('/settings/about', [AboutSettingController::class, 'update'])->name('about.update');
});
