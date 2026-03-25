<?php

namespace App\Http\Controllers;

use App\Models\BusinessUnit;
use Illuminate\Http\Request;

class BusinessUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $businessUnits = BusinessUnit::latest()->paginate(10);
        return view('business-units.index', compact('businessUnits'));
    }

    public function create()
    {
        return view('business-units.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'business_unit_code' => 'nullable|unique:business_units',
            'business_unit_name' => 'required',
            'status' => 'boolean',
        ]);

        BusinessUnit::create($request->all());

        return redirect()->route('business-units.index')->with('success', 'Business unit registered successfully.');
    }

    public function edit(BusinessUnit $businessUnit)
    {
        return view('business-units.edit', compact('businessUnit'));
    }

    public function update(Request $request, BusinessUnit $businessUnit)
    {
        $request->validate([
            'business_unit_code' => 'nullable|unique:business_units,business_unit_code,' . $businessUnit->id,
            'business_unit_name' => 'required',
            'status' => 'boolean',
        ]);

        $businessUnit->update($request->all());

        return redirect()->route('business-units.index')->with('success', 'Business unit updated successfully.');
    }

    public function destroy(BusinessUnit $businessUnit)
    {
        $businessUnit->delete();
        return redirect()->route('business-units.index')->with('success', 'Business unit deleted successfully.');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt|max:2048',
        ]);

        $file = $request->file('file');
        $csvData = file_get_contents($file);
        $rows = array_map('str_getcsv', explode("\n", $csvData));
        $header = array_shift($rows); // Remove header row if present

        $imported = 0;
        foreach ($rows as $row) {
            if (count($row) < 2 || empty($row[0])) continue; // Skip empty rows

            // Assuming typical header sequence based on the fields:
            // Business Unit Code, Business Unit Name
            $business_unit_code = isset($row[0]) ? trim($row[0]) : null;
            $business_unit_name = isset($row[1]) ? trim($row[1]) : null;

            if ($business_unit_name) {
                // Determine update condition based on whether code is present
                $attributes = ['business_unit_name' => $business_unit_name];
                
                if ($business_unit_code) {
                    $attributes = ['business_unit_code' => $business_unit_code];
                }

                BusinessUnit::updateOrCreate(
                    $attributes,
                    [
                        'business_unit_name' => $business_unit_name,
                        'business_unit_code' => $business_unit_code,
                        'status' => true,
                    ]
                );
                $imported++;
            }
        }

        return redirect()->route('business-units.index')->with('success', "{$imported} business units imported successfully.");
    }
}
