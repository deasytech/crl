<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PrivacyController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SeoController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TeamController;
use Illuminate\Support\Facades\Route;

// Public website. Only published content is ever queried here.
Route::get('/', HomeController::class)->name('home');
Route::get('company', CompanyController::class)->name('company');
Route::get('services', [ServiceController::class, 'index'])->name('services.index');
Route::get('services/{service:slug}', [ServiceController::class, 'show'])->name('services.show');
Route::get('projects', [ProjectController::class, 'index'])->name('projects.index');
Route::get('projects/{project:slug}', [ProjectController::class, 'show'])->name('projects.show');
Route::get('team', TeamController::class)->name('team');
Route::get('contact', [ContactController::class, 'show'])->name('contact');
Route::get('privacy', PrivacyController::class)->name('privacy');
Route::post('contact', [ContactController::class, 'store'])->middleware('throttle:5,10')->name('contact.store');

Route::get('sitemap.xml', [SeoController::class, 'sitemap'])->name('sitemap');

// The starter-kit dashboard is replaced by the Filament panel.
Route::redirect('dashboard', '/admin')->name('dashboard');

require __DIR__.'/settings.php';
