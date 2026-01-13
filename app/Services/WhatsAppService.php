<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class WhatsAppService
{
    protected $baseUrl;
    protected $token;

    public function __construct()
    {
        $this->baseUrl = config('services.whatsapp.base_url');
        $this->token = config('services.whatsapp.token');
    }

    /**
     * Send a message via WhatsApp Business API
     */
    public function sendMessage($to, $message)
    {
        // In a real implementation, you would make an API call to WhatsApp Business API
        // For now, we'll simulate the functionality
        
        // Example API call structure (would be uncommented in real implementation):
        /*
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
            'Content-Type' => 'application/json',
        ])->post($this->baseUrl . '/messages', [
            'messaging_product' => 'whatsapp',
            'to' => $to,
            'type' => 'text',
            'text' => [
                'body' => $message
            ]
        ]);

        return $response->successful();
        */
        
        // For demonstration purposes, we'll just return true
        return true;
    }

    /**
     * Send booking confirmation message
     */
    public function sendBookingConfirmation($booking)
    {
        $message = "Booking Confirmation!\n";
        $message .= "ID: #" . $booking->idBooking . "\n";
        $message .= "Date: " . \Carbon\Carbon::parse($booking->tanggalAcara)->format('M d, Y') . "\n";
        $message .= "Time: " . \Carbon\Carbon::parse($booking->waktuAcara)->format('g:i A') . "\n";
        $message .= "Location: " . $booking->lokasiAcara . "\n";
        $message .= "Total: Rp " . number_format($booking->totalHarga, 0, ',', '.') . "\n";
        $message .= "Thank you for choosing Vidiooo!";

        return $this->sendMessage($booking->guest->phone ?? 'default_number', $message);
    }

    /**
     * Send payment confirmation message
     */
    public function sendPaymentConfirmation($payment)
    {
        $message = "Payment Received!\n";
        $message .= "Amount: Rp " . number_format($payment->jumlah, 0, ',', '.') . "\n";
        $message .= "Method: " . ucfirst(str_replace('_', ' ', $payment->metodePembayaran)) . "\n";
        $message .= "Status: " . ucfirst($payment->statusPembayaran) . "\n";
        $message .= "Thank you for your payment!";

        return $this->sendMessage($payment->booking->guest->phone ?? 'default_number', $message);
    }

    /**
     * Send reminder message
     */
    public function sendReminder($booking, $daysBefore = 3)
    {
        $eventDate = \Carbon\Carbon::parse($booking->tanggalAcara);
        $reminderDate = $eventDate->subDays($daysBefore);

        $message = "Reminder: Your event is coming up!\n";
        $message .= "Date: " . $eventDate->format('M d, Y') . "\n";
        $message .= "Time: " . \Carbon\Carbon::parse($booking->waktuAcara)->format('g:i A') . "\n";
        $message .= "Location: " . $booking->lokasiAcara . "\n";
        $message .= "Please confirm your attendance.";

        return $this->sendMessage($booking->guest->phone ?? 'default_number', $message);
    }
}