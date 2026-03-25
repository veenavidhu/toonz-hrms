<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::latest()->paginate(10);
        return view('companies.index', compact('companies'));
    }

    public function create()
    {
        $countries = Country::where('status', true)->orderBy('name')->get();
        return view('companies.create', compact('countries'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'company_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'company_address' => 'required|string',
            'country_id' => 'required|exists:countries,id',
            'state_id' => 'required|exists:states,id',
            'city_id' => 'required|exists:cities,id',
            'postal_code' => 'required|string|max:50',
            'phone_no' => 'required|string|max:50',
            'fax_no' => 'nullable|string|max:50',
            'pf_no' => 'required|string|max:100',
            'esi_no' => 'required|string|max:100',
            'pan_no' => 'required|string|max:50',
            'tan_no' => 'required|string|max:50',
            'tds_circle' => 'required|string|max:100',
            'uen' => 'required|string|max:100',
            'gst_no' => 'nullable|string|max:100',
            'registration_no' => 'required|string|max:100',
            'lst_no' => 'required|string|max:100',
            'cst_no' => 'required|string|max:100',
            'service_tax_no' => 'required|string|max:100',
            'email_id' => 'required|email|max:255',
            'website' => 'nullable|url|max:255',
            'reg_address' => 'required|string',
            'reg_city' => 'required|string|max:100',
            'reg_pin_no' => 'required|string|max:50',
        ]);

        if ($request->hasFile('company_logo')) {
            $imageName = time().'.'.$request->company_logo->extension();  
            $request->company_logo->move(public_path('images/companies'), $imageName);
            $validated['company_logo'] = 'images/companies/'.$imageName;
        }

        Company::create($validated);

        return redirect()->route('companies.index')->with('success', 'Company saved successfully.');
    }

    public function edit(Company $company)
    {
        $countries = Country::where('status', true)->orderBy('name')->get();
        return view('companies.edit', compact('company', 'countries'));
    }

    public function update(Request $request, Company $company)
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'company_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'company_address' => 'required|string',
            'country_id' => 'required|exists:countries,id',
            'state_id' => 'required|exists:states,id',
            'city_id' => 'required|exists:cities,id',
            'postal_code' => 'required|string|max:50',
            'phone_no' => 'required|string|max:50',
            'fax_no' => 'nullable|string|max:50',
            'pf_no' => 'required|string|max:100',
            'esi_no' => 'required|string|max:100',
            'pan_no' => 'required|string|max:50',
            'tan_no' => 'required|string|max:50',
            'tds_circle' => 'required|string|max:100',
            'uen' => 'required|string|max:100',
            'gst_no' => 'nullable|string|max:100',
            'registration_no' => 'required|string|max:100',
            'lst_no' => 'required|string|max:100',
            'cst_no' => 'required|string|max:100',
            'service_tax_no' => 'required|string|max:100',
            'email_id' => 'required|email|max:255',
            'website' => 'nullable|url|max:255',
            'reg_address' => 'required|string',
            'reg_city' => 'required|string|max:100',
            'reg_pin_no' => 'required|string|max:50',
        ]);

        if ($request->hasFile('company_logo')) {
            $imageName = time().'.'.$request->company_logo->extension();  
            $request->company_logo->move(public_path('images/companies'), $imageName);
            $validated['company_logo'] = 'images/companies/'.$imageName;
            
            // Delete old logo
            if ($company->company_logo && file_exists(public_path($company->company_logo))) {
                unlink(public_path($company->company_logo));
            }
        }

        $company->update($validated);

        return redirect()->route('companies.index')->with('success', 'Company updated successfully.');
    }

    public function destroy(Company $company)
    {
        if ($company->company_logo && file_exists(public_path($company->company_logo))) {
            unlink(public_path($company->company_logo));
        }
        
        $company->delete();
        return redirect()->route('companies.index')->with('success', 'Company deleted successfully.');
    }
}
