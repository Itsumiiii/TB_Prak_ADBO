<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\Booking;

class ScheduleController extends Controller
{
    /**
     * Display a listing of schedules.
     */
    public function index()
    {
        $schedules = Schedule::all();
        return view('admin.schedule.index', compact('schedules'));
    }

    /**
     * Block a date in the schedule.
     */
    public function blockDate(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'alasanDiblokir' => 'required|string|max:255'
        ]);

        // Check if schedule exists for this date
        $schedule = Schedule::where('tanggal', $request->tanggal)->first();

        if ($schedule) {
            // Update existing schedule
            $schedule->tersedia = false;
            $schedule->alasanDiblokir = $request->alasanDiblokir;
            $schedule->save();
        } else {
            // Create new schedule entry
            $schedule = new Schedule();
            $schedule->idJadwal = 'SCH' . strtoupper(substr(md5(uniqid()), 0, 8)); // Generate unique ID
            $schedule->tanggal = $request->tanggal;
            $schedule->tersedia = false;
            $schedule->alasanDiblokir = $request->alasanDiblokir;
            $schedule->save();
        }

        return redirect()->back()->with('success', 'Date blocked successfully!');
    }

    /**
     * Check for conflicts in the schedule.
     */
    public function checkConflict(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date'
        ]);

        // Check if there's a booking for this date
        $bookingExists = Booking::where('tanggalAcara', $request->tanggal)
            ->where('status', '!=', 'cancelled')
            ->exists();

        // Check if the date is blocked
        $dateBlocked = Schedule::where('tanggal', $request->tanggal)
            ->where('tersedia', false)
            ->exists();

        $hasConflict = $bookingExists || $dateBlocked;

        return response()->json(['hasConflict' => $hasConflict]);
    }
}
