<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Portfolio;
use App\Models\Package;
use App\Models\Booking;
use App\Models\Testimonial;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function index()
    {
        // Get quick stats for the dashboard
        $totalPortfolios = Portfolio::count();
        $totalPackages = Package::count();
        $pendingBookings = Booking::where('status', 'pending')->count();
        $pendingTestimonials = Testimonial::where('disetujui', false)->count();

        // Get recent activities
        $recentBookings = Booking::latest()->take(5)->get();
        $recentPayments = []; // Will implement payment functionality later

        return view('admin.dashboard', compact(
            'totalPortfolios',
            'totalPackages',
            'pendingBookings',
            'pendingTestimonials',
            'recentBookings'
        ));
    }
}
