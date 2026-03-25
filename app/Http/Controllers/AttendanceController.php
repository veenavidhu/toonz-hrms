<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        
        if ($user->hasRole(['Super Admin', 'Admin', 'HR'])) {
            $attendances = Attendance::with('user')->orderBy('date', 'desc')->get();
        } else {
            $attendances = Attendance::where('user_id', $user->id)->orderBy('date', 'desc')->get();
        }

        $todayAttendance = Attendance::where('user_id', $user->id)
            ->where('date', Carbon::today()->toDateString())
            ->first();

        return view('attendance.index', compact('attendances', 'todayAttendance'));
    }

    public function clockIn(Request $request)
    {
        $user = Auth::user();
        $today = Carbon::today()->toDateString();

        $existing = Attendance::where('user_id', $user->id)->where('date', $today)->first();
        if ($existing) {
            return back()->with('error', 'Already clocked in for today.');
        }

        $now = Carbon::now();
        $isLate = $now->hour >= 9 && $now->minute > 30; // 9:30 AM threshold

        Attendance::create([
            'user_id' => $user->id,
            'date' => $today,
            'clock_in' => $now->toTimeString(),
            'status' => 'Present',
            'is_late' => $isLate,
        ]);

        return back()->with('success', 'Clocked in successfully at ' . $now->format('H:i'));
    }

    public function clockOut(Request $request)
    {
        $user = Auth::user();
        $today = Carbon::today()->toDateString();

        $attendance = Attendance::where('user_id', $user->id)->where('date', $today)->first();
        
        if (!$attendance) {
            return back()->with('error', 'No clock-in record found for today.');
        }

        if ($attendance->clock_out) {
            return back()->with('error', 'Already clocked out for today.');
        }

        $attendance->update([
            'clock_out' => Carbon::now()->toTimeString(),
        ]);

        return back()->with('success', 'Clocked out successfully.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Attendance $attendance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attendance $attendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Attendance $attendance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attendance $attendance)
    {
        //
    }
}
