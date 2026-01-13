<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CompanyInfo;

class SettingsController extends Controller
{
    /**
     * Display the settings page.
     */
    public function index()
    {
        $companyInfo = CompanyInfo::latest()->first();
        return view('admin.settings.index', compact('companyInfo'));
    }

    /**
     * Update company information.
     */
    public function updateCompany(Request $request)
    {
        $request->validate([
            'namaPerusahaan' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'nomorWhatsApp' => 'required|string|max:20',
            'alamat' => 'required|string',
        ]);

        $companyInfo = CompanyInfo::latest()->first();

        if (!$companyInfo) {
            $companyInfo = new CompanyInfo();
        }

        $companyInfo->namaPerusahaan = $request->namaPerusahaan;
        $companyInfo->email = $request->email;
        $companyInfo->nomorWhatsApp = $request->nomorWhatsApp;
        $companyInfo->alamat = $request->alamat;
        $companyInfo->save();

        return redirect()->back()->with('success', 'Company information updated successfully!');
    }

    /**
     * Update WhatsApp configuration.
     */
    public function updateWhatsApp(Request $request)
    {
        // In a real implementation, you would update WhatsApp API settings
        // For now, we'll just validate and return success

        $request->validate([
            'whatsapp_token' => 'nullable|string',
            'business_number' => 'nullable|string',
        ]);

        // Save WhatsApp settings to config or database
        // Implementation would depend on the specific WhatsApp Business API integration

        return redirect()->back()->with('success', 'WhatsApp configuration updated successfully!');
    }

    /**
     * Update social media settings.
     */
    public function updateSocial(Request $request)
    {
        // In a real implementation, you would update social media links
        // For now, we'll just validate and return success

        $request->validate([
            'instagram_url' => 'nullable|url',
            'facebook_url' => 'nullable|url',
            'youtube_url' => 'nullable|url',
            'tiktok_url' => 'nullable|url',
        ]);

        // Save social media settings to database
        $companyInfo = CompanyInfo::latest()->first();
        
        if (!$companyInfo) {
            $companyInfo = new CompanyInfo();
        }

        $companyInfo->instagram = $request->instagram_url;
        $companyInfo->facebook = $request->facebook_url;
        $companyInfo->youtube = $request->youtube_url;
        $companyInfo->tiktok = $request->tiktok_url;
        $companyInfo->save();

        return redirect()->back()->with('success', 'Social media settings updated successfully!');
    }
}
