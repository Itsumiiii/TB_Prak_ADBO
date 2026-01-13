<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CompanyInfo;

class WhatsAppController extends Controller
{
    /**
     * Redirect to WhatsApp chat with the company.
     */
    public function redirectToChat()
    {
        $companyInfo = CompanyInfo::first();

        if (!$companyInfo) {
            abort(404, 'Company information not found');
        }

        // Remove any non-digit characters from the phone number
        $phoneNumber = preg_replace('/[^0-9]/', '', $companyInfo->nomorWhatsApp);

        // Format the phone number for WhatsApp (without country code prefix)
        if (substr($phoneNumber, 0, 1) === '0') {
            $phoneNumber = substr($phoneNumber, 1);
        }

        // Add country code (assuming Indonesia's country code is 62)
        $formattedNumber = '62' . $phoneNumber;

        // Prepare a default message
        $message = urlencode('Hello, I am interested in your services.');

        // Redirect to WhatsApp
        return redirect("https://wa.me/{$formattedNumber}?text={$message}");
    }
}
