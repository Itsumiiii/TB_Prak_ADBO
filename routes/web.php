<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\WhatsAppController;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact', [HomeController::class, 'sendMessage'])->name('contact.send');

// Portfolio routes
Route::get('/portfolio', [PortfolioController::class, 'index'])->name('portfolio.index');
Route::get('/portfolio/{id}', [PortfolioController::class, 'show'])->name('portfolio.show');
Route::get('/portfolio/category/{category}', [PortfolioController::class, 'filterByCategory'])->name('portfolio.category');
Route::post('/portfolio/{id}/track', [PortfolioController::class, 'trackView'])->name('portfolio.track');

// Packages routes
Route::get('/packages', [PackageController::class, 'index'])->name('packages.index');
Route::get('/packages/{id}', [PackageController::class, 'show'])->name('packages.show');

// Booking routes
Route::get('/booking', [BookingController::class, 'create'])->name('booking.create');
Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
Route::get('/booking/{id}/success', [BookingController::class, 'success'])->name('booking.success');
Route::post('/booking/check-available', [BookingController::class, 'checkAvailability'])->name('booking.check-available');
Route::get('/booking/{id}/payment', [BookingController::class, 'payment'])->name('booking.payment');
Route::post('/booking/{id}/payment', [BookingController::class, 'uploadPayment'])->name('booking.payment.upload');

Route::get('/testimonials', [TestimonialController::class, 'index'])->name('testimonials.index');

// WhatsApp routes
Route::get('/whatsapp/chat', [WhatsAppController::class, 'redirectToChat'])->name('whatsapp.chat');

// Admin routes
Route::prefix('admin')->name('admin.')->group(base_path('routes/admin.php'));
