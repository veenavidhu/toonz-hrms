<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class LeaveController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->hasRole(['Super Admin', 'Admin', 'HR'])) {
            $leaves = Leave::with('user')->orderBy('created_at', 'desc')->get();
        } elseif ($user->hasRole('Manager')) {
            // Manager sees leaves of their department
            $departmentId = $user->employee->department_id ?? null;
            $leaves = Leave::whereHas('user.employee', function($q) use ($departmentId) {
                $q->where('department_id', $departmentId);
            })->with('user')->orderBy('created_at', 'desc')->get();
        } else {
            $leaves = Leave::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
        }

        return view('leaves.index', compact('leaves'));
    }

    public function create()
    {
        return view('leaves.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:Annual,Sick,Unpaid,Other',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'required|string',
        ]);

        $start = Carbon::parse($request->start_date);
        $end = Carbon::parse($request->end_date);
        $days = $start->diffInDays($end) + 1;

        Leave::create([
            'user_id' => Auth::id(),
            'type' => $request->type,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'days' => $days,
            'reason' => $request->reason,
            'status' => 'Pending',
        ]);

        return redirect()->route('leaves.index')->with('success', 'Leave request submitted successfully.');
    }

    public function approve(Request $request, Leave $leave)
    {
        $request->validate(['status' => 'required|in:Approved,Rejected']);

        $leave->update([
            'status' => $request->status,
            'approved_by' => Auth::id(),
        ]);

        return back()->with('success', 'Leave request ' . strtolower($request->status) . '.');
    }
}
