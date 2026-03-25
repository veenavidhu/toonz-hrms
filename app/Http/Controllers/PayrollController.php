<?php

namespace App\Http\Controllers;

use App\Models\Payroll;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class PayrollController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->hasRole(['Super Admin', 'Admin', 'HR'])) {
            $payrolls = Payroll::with('user')->orderBy('year', 'desc')->orderBy('month', 'desc')->get();
            $employees = User::whereNotNull('employee_id')->get();
        } else {
            $payrolls = Payroll::where('user_id', $user->id)->orderBy('year', 'desc')->orderBy('month', 'desc')->get();
            $employees = collect();
        }

        return view('payroll.index', compact('payrolls', 'employees'));
    }

    public function downloadPayslip(Payroll $payroll)
    {
        // Security check: Only Admin, HR, or the owner can download
        if (!Auth::user()->hasRole(['Super Admin', 'Admin', 'HR']) && Auth::id() !== $payroll->user_id) {
            abort(403);
        }

        $pdf = Pdf::loadView('payroll.payslip', compact('payroll'));
        return $pdf->download('payslip_'.$payroll->user->name.'_'.$payroll->month.'.pdf');
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
    public function show(Payroll $payroll)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payroll $payroll)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payroll $payroll)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payroll $payroll)
    {
        //
    }
}
