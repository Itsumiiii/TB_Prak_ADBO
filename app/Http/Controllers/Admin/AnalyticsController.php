<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Analytics;
use App\Models\Portfolio;
use Carbon\Carbon;

class AnalyticsController extends Controller
{
    /**
     * Display the analytics dashboard.
     */
    public function index()
    {
        // Get analytics data for the current month
        $startDate = Carbon::now()->startOfMonth();
        $endDate = Carbon::now()->endOfMonth();

        $analytics = Analytics::whereBetween('date', [$startDate, $endDate])->get();

        // Calculate totals
        $totalPageViews = $analytics->sum('pageViews');
        $totalUniqueVisitors = $analytics->sum('uniqueVisitors');
        $totalBookings = \App\Models\Booking::count();

        // Get popular portfolio
        // $popularPortfolioId = $analytics->sortByDesc('popularPortfolio')->first();
        // $popularPortfolio = $popularPortfolioId ? Portfolio::find($popularPortfolioId->popularPortfolio) : null;
        // Better: Just take the portfolio with max views directly
        $popularPortfolio = Portfolio::orderByDesc('jumlahTayangan')->first();

        // Calculate conversion rate: Bookings / Total Page Views
        $conversionRate = $totalPageViews > 0 ? ($totalBookings / $totalPageViews) * 100 : 0;

        // Get top content for table
        $topContent = Portfolio::orderBy('jumlahTayangan', 'desc')->take(5)->get();

        // Prepare Page Views Chart Data (Last 30 Days)
        $chartStartDate = Carbon::now()->subDays(29);
        $chartDataQuery = Analytics::where('date', '>=', $chartStartDate)
            ->orderBy('date', 'asc')
            ->get();
        
        $chartLabels = $chartDataQuery->pluck('date')->map(fn($date) => $date->format('M d'))->toArray();
        $chartValues = $chartDataQuery->pluck('pageViews')->toArray();

        // Fill in missing dates with 0 if needed (optional but good for charts)
        // For simplicity, we stick to available data for now, but strictly we should fill gaps.
        
        // Prepare Top Content Chart Data
        $topContentChart = Portfolio::orderBy('jumlahTayangan', 'desc')->take(5)->get();
        $topContentLabels = $topContentChart->pluck('judul')->toArray();
        $topContentValues = $topContentChart->pluck('jumlahTayangan')->toArray();

        return view('admin.analytics.index', compact(
            'totalPageViews',
            'totalUniqueVisitors',
            'popularPortfolio',
            'conversionRate',
            'topContent',
            'chartLabels',
            'chartValues',
            'topContentLabels',
            'topContentValues'
        ));
    }

    /**
     * Track a view.
     */
    public function trackView(Request $request)
    {
        $request->validate([
            'page' => 'required|string',
            'user_id' => 'nullable|string',
        ]);

        // Create or update analytics record for today
        $today = Carbon::today();
        $analytics = Analytics::firstOrCreate(
            ['date' => $today],
            [
                'analyticsId' => 'AN' . strtoupper(substr(md5(uniqid()), 0, 8)), // Generate unique ID
                'pageViews' => 0,
                'uniqueVisitors' => 0,
                'popularPortfolio' => null,
                'conversionRate' => 0.00,
            ]
        );

        $analytics->increment('pageViews');

        // Add logic to track unique visitors if needed
        // For now, we'll just increment the counter
        $analytics->save();

        return response()->json(['success' => true]);
    }

    /**
     * Generate a report.
     */
    public function generateReport(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);

        $analytics = Analytics::whereBetween('date', [$startDate, $endDate])->get();

        $report = [
            'period' => [
                'start' => $startDate->format('Y-m-d'),
                'end' => $endDate->format('Y-m-d'),
            ],
            'total_page_views' => $analytics->sum('pageViews'),
            'total_unique_visitors' => $analytics->sum('uniqueVisitors'),
            'average_page_views_per_day' => $analytics->avg('pageViews'),
            'average_unique_visitors_per_day' => $analytics->avg('uniqueVisitors'),
        ];

        return response()->json($report);
    }

    /**
     * Get top content.
     */
    public function getTopContent()
    {
        $topContent = Portfolio::orderBy('jumlahTayangan', 'desc')->take(10)->get();

        return response()->json($topContent);
    }
}
