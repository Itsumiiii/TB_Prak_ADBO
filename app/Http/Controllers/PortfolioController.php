<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Portfolio;
use App\Models\CompanyInfo;

class PortfolioController extends Controller
{
    /**
     * Display a listing of portfolios.
     */
    public function index()
    {
        $portfolios = Portfolio::where('aktif', true)->paginate(9);
        $categories = Portfolio::select('kategori')->distinct()->pluck('kategori');

        return view('portfolio.index', compact('portfolios', 'categories'));
    }

    /**
     * Display a specific portfolio.
     */
    public function show($id)
    {
        $portfolio = Portfolio::where('idPortofolio', $id)->where('aktif', true)->firstOrFail();

        // Increment view count
        $portfolio->increment('jumlahTayangan');

        // Track in Analytics
        $today = \Carbon\Carbon::today();
        $analytics = \App\Models\Analytics::firstOrCreate(
            ['date' => $today],
            [
                'analyticsId' => 'AN' . strtoupper(substr(md5(uniqid()), 0, 8)),
                'pageViews' => 0,
                'uniqueVisitors' => 0,
                'popularPortfolio' => null,
                'conversionRate' => 0.00,
            ]
        );
        $analytics->increment('pageViews');

        return view('portfolio.show', compact('portfolio'));
    }

    /**
     * Filter portfolios by category.
     */
    public function filterByCategory($category)
    {
        $portfolios = Portfolio::where('aktif', true)
            ->where('kategori', $category)
            ->paginate(9);

        $categories = Portfolio::select('kategori')->distinct()->pluck('kategori');

        return view('portfolio.index', compact('portfolios', 'categories'));
    }

    /**
     * Track portfolio view.
     */
    public function trackView($id)
    {
        $portfolio = Portfolio::find($id);

        if ($portfolio) {
            $portfolio->increment('jumlahTayangan');
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 404);
    }
}
