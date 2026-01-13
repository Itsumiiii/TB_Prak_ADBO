<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
    /**
     * Display a listing of notifications.
     */
    public function index()
    {
        $notifications = Notification::all();
        return view('admin.notifications.index', compact('notifications'));
    }

    /**
     * Mark the specified notification as read.
     */
    public function markAsRead($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->sudahDibaca = true;
        $notification->save();

        return response()->json(['success' => true]);
    }

    /**
     * Send a new notification.
     */
    public function send(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'pesan' => 'required|string',
            'recipient_type' => 'required|in:admin,user',
            'recipient_id' => 'required|string',
        ]);

        $notification = new Notification();
        $notification->idNotifikasi = 'NTF' . strtoupper(substr(md5(uniqid()), 0, 8)); // Generate unique ID
        $notification->judul = $request->judul;
        $notification->pesan = $request->pesan;
        $notification->recipient_type = $request->recipient_type;
        $notification->recipient_id = $request->recipient_id;
        $notification->save();

        return redirect()->back()->with('success', 'Notification sent successfully!');
    }
}
