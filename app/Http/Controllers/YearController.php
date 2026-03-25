<?php

namespace App\Http\Controllers;

use App\Models\Year;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class YearController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $years = Year::with(['company', 'creator'])
            ->when($search, function ($query) use ($search) {
                $query->where('year_name', 'like', "%{$search}%")
                      ->orWhere('year_type', 'like', "%{$search}%");
            })->latest()->paginate(10)->withQueryString();

        return view('years.index', compact('years', 'search'));
    }

    public function create()
    {
        $companies = Company::all();
        return view('years.create', compact('companies'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'year_type'          => 'required|string',
            'start_date'         => 'required|date',
            'year_name'          => 'required|string',
            'ou_based_selection' => 'required|string',
            'company_id'         => 'required|exists:companies,id',
            'pay_calc_status'    => 'boolean',
            'status'             => 'boolean',
        ]);

        Year::create([
            'year_type'          => $request->year_type,
            'start_date'         => $request->start_date,
            'year_name'          => $request->year_name,
            'ou_based_selection' => $request->ou_based_selection,
            'company_id'         => $request->company_id,
            'pay_calc_status'    => $request->has('pay_calc_status') ? (bool) $request->pay_calc_status : true,
            'status'             => $request->has('status') ? (bool) $request->status : true,
            'created_by'         => Auth::id(),
        ]);

        return redirect()->route('years.index')
                         ->with('success', 'Year created successfully.');
    }

    public function edit(Year $year)
    {
        $companies = Company::all();
        return view('years.edit', compact('year', 'companies'));
    }

    public function update(Request $request, Year $year)
    {
        $request->validate([
            'year_type'          => 'required|string',
            'start_date'         => 'required|date',
            'year_name'          => 'required|string',
            'ou_based_selection' => 'required|string',
            'company_id'         => 'required|exists:companies,id',
            'pay_calc_status'    => 'boolean',
            'status'             => 'boolean',
        ]);

        $year->update([
            'year_type'          => $request->year_type,
            'start_date'         => $request->start_date,
            'year_name'          => $request->year_name,
            'ou_based_selection' => $request->ou_based_selection,
            'company_id'         => $request->company_id,
            'pay_calc_status'    => $request->has('pay_calc_status') ? (bool) $request->pay_calc_status : false,
            'status'             => $request->has('status') ? (bool) $request->status : false,
        ]);

        return redirect()->route('years.index')
                         ->with('success', 'Year updated successfully.');
    }

    public function destroy(Year $year)
    {
        $year->delete();
        return redirect()->route('years.index')
                         ->with('success', 'Year deleted successfully.');
    }
}
