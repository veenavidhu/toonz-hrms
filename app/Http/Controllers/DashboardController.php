<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\User;
use App\Models\Department;
use App\Models\Attendance;
use App\Models\Leave;
use App\Models\Announcement;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function admin()
    {
        $stats = [
            'total_employees' => User::whereNotNull('employee_id')->count(),
            'total_departments' => Department::count(),
            'present_today' => Attendance::where('date', Carbon::today()->toDateString())->count(),
            'pending_leaves' => Leave::where('status', 'Pending')->count(),
        ];

        $announcements = Announcement::latest()->take(5)->get();
        
        $birthdays = User::whereNotNull('employee_id')
            ->whereMonth('dob', Carbon::now()->month)
            ->get();

        // Chart Data: Attendance for the last 7 days
        $attendanceData = [];
        $attendanceLabels = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i)->toDateString();
            $attendanceLabels[] = Carbon::today()->subDays($i)->format('D');
            $attendanceData[] = Attendance::where('date', $date)->count();
        }

        // Chart Data: Employee Distribution by Department
        $deptStats = Department::withCount('employees')->get();
        $deptLabels = $deptStats->pluck('name');
        $deptCounts = $deptStats->pluck('employees_count');

        return view('dashboard.admin', compact('stats', 'announcements', 'birthdays', 'attendanceData', 'attendanceLabels', 'deptLabels', 'deptCounts'));
    }

    public function hr()
    {
        return $this->admin(); // HR sees similar overview but with limited sidebar
    }

    public function manager(): View
    {
        return view('dashboard.manager');
    }

    public function employee(): View
    {
        return view('dashboard.employee');
    }
}
