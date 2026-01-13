<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Portfolio;
use App\Models\Package;
use App\Models\Testimonial;
use App\Models\CompanyInfo;

class HomeController extends Controller
{
    /**
     * Show the homepage.
     */
    public function index()
    {
        $featuredPortfolios = Portfolio::where('aktif', true)->limit(6)->get();
        $packages = Package::where('aktif', true)->get();
        $testimonials = Testimonial::where('disetujui', true)->limit(4)->get();

        // Get company info for stats
        $companyInfo = CompanyInfo::first();

        // Calculate stats (these would come from your analytics in a real implementation)
        $stats = [
            'totalProjects' => $featuredPortfolios->count(),
            'happyClients' => 150, // Placeholder
            'yearsExperience' => 5, // Placeholder
            'awards' => 12, // Placeholder
        ];

        return view('home', compact('featuredPortfolios', 'packages', 'testimonials', 'stats'));
    }

    /**
     * Show the about page.
     */
    public function about()
    {
        $companyInfo = CompanyInfo::first();

        return view('about', compact('companyInfo'));
    }

    /**
     * Show the contact page.
     */
    public function contact()
    {
        $companyInfo = CompanyInfo::first();

        return view('contact', compact('companyInfo'));
    }

    /**
     * Handle contact form submission.
     */
    public function sendMessage(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Create new message (assuming you have a Message model, or create one)
        // For now, let's create a Migration and Model for Messages if they don't exist.
        // If not, we can just flash a success message for now to show it works, 
        // but better to save it. 
        
        \App\Models\Message::create($request->except('_token'));

        return redirect()->back()->with('success', 'Thank you! Your message has been sent successfully.');
    }
}
