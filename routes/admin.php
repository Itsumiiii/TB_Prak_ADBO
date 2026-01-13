<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PortfolioController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\AnalyticsController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\NotificationController;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application.
| These routes are loaded by the RouteServiceProvider within a group
| which contains the "admin" middleware group.
|
*/

// Authentication routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Protected routes (require admin authentication)
Route::group(['middleware' => ['auth.admin']], function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Portfolio Management
    Route::resource('portfolio', PortfolioController::class);
    Route::post('/portfolio/{id}/publish', [PortfolioController::class, 'publish'])->name('portfolio.publish');

    // Package Management
    Route::resource('packages', PackageController::class);
    Route::post('/packages/{id}/calculate', [PackageController::class, 'calculatePrice'])->name('packages.calculate');

    // Booking Management
    Route::resource('bookings', BookingController::class);
    Route::put('/bookings/{id}/confirm', [BookingController::class, 'confirm'])->name('bookings.confirm');
    Route::put('/bookings/{id}/complete', [BookingController::class, 'complete'])->name('bookings.complete');
    Route::put('/bookings/{id}/cancel', [BookingController::class, 'cancel'])->name('bookings.cancel');
    Route::get('/bookings/calendar', [BookingController::class, 'calendar'])->name('bookings.calendar');

    // Schedule Management
    Route::resource('schedule', ScheduleController::class);
    Route::post('/schedule/block', [ScheduleController::class, 'blockDate'])->name('schedule.block');
    Route::post('/schedule/check-conflict', [ScheduleController::class, 'checkConflict'])->name('schedule.conflict');

    // Payment Management
    Route::resource('payments', PaymentController::class);
    Route::post('/payments/{id}/verify', [PaymentController::class, 'verify'])->name('payments.verify');
    Route::post('/payments/{id}/process', [PaymentController::class, 'process'])->name('payments.process');

    // Testimonial Management
    Route::resource('testimonials', TestimonialController::class);
    Route::put('/testimonials/{id}/approve', [TestimonialController::class, 'approve'])->name('testimonials.approve');
    Route::put('/testimonials/{id}/reject', [TestimonialController::class, 'reject'])->name('testimonials.reject');

    // Analytics
    Route::get('/analytics', [AnalyticsController::class, 'index'])->name('analytics.index');
    Route::post('/analytics/track', [AnalyticsController::class, 'trackView'])->name('analytics.track');
    Route::post('/analytics/report', [AnalyticsController::class, 'generateReport'])->name('analytics.report');
    Route::get('/analytics/top-content', [AnalyticsController::class, 'getTopContent'])->name('analytics.top-content');

    // Settings
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::put('/settings/company', [SettingsController::class, 'updateCompany'])->name('settings.company.update');
    Route::put('/settings/whatsapp', [SettingsController::class, 'updateWhatsApp'])->name('settings.whatsapp.update');
    Route::put('/settings/social', [SettingsController::class, 'updateSocial'])->name('settings.social.update');

    // Notifications
    Route::resource('notifications', NotificationController::class);
    Route::put('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::post('/notifications/send', [NotificationController::class, 'send'])->name('notifications.send');
});