<?php

use App\Http\Controllers\Admin\{CategoryController, CertificateController, DashboardController, EducationController,
    ExperienceController, MessageController, ProfileController, ProjectController, SkillController};
use App\Http\Controllers\{AuthController, PageController};
use Illuminate\Support\Facades\Route;

// ===== FRONTEND (publik) =====
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/skills', [PageController::class, 'skills'])->name('skills');
Route::get('/projects', [PageController::class, 'projects'])->name('projects');
Route::get('/certificates', [PageController::class, 'certificates'])->name('certificates');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [PageController::class, 'sendContact'])->middleware('throttle:5,1')->name('contact.send');
Route::get('/download-cv', [PageController::class, 'downloadCv'])->name('cv.download');

// ===== LOGIN / LOGOUT =====
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.process');
});
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// ===== DASHBOARD ADMIN (dilindungi middleware auth) =====
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::resource('educations', EducationController::class)->except('show');
    Route::resource('experiences', ExperienceController::class)->except('show');
    Route::resource('skills', SkillController::class)->except('show');
    Route::resource('categories', CategoryController::class)->except('show');
    Route::resource('projects', ProjectController::class)->except('show');
    Route::resource('certificates', CertificateController::class)->except('show');

    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/{id}', [MessageController::class, 'show'])->name('messages.show');
    Route::delete('/messages/{id}', [MessageController::class, 'destroy'])->name('messages.destroy');
});
