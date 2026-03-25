<?php

namespace App\Http\Controllers;

use App\Models\SubBusinessUnit;
use Illuminate\Http\Request;

class SubBusinessUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subBusinessUnits = SubBusinessUnit::latest()->paginate(10);
        return view('sub-business-units.index', compact('subBusinessUnits'));
    }

    public function create()
    {
        return view('sub-business-units.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'sub_business_unit_name' => 'required',
            'status' => 'boolean',
        ]);

        SubBusinessUnit::create($request->all());

        return redirect()->route('sub-business-units.index')->with('success', 'Sub business unit registered successfully.');
    }

    public function edit(SubBusinessUnit $subBusinessUnit)
    {
        return view('sub-business-units.edit', compact('subBusinessUnit'));
    }

    public function update(Request $request, SubBusinessUnit $subBusinessUnit)
    {
        $request->validate([
            'sub_business_unit_name' => 'required',
            'status' => 'boolean',
        ]);

        $subBusinessUnit->update($request->all());

        return redirect()->route('sub-business-units.index')->with('success', 'Sub business unit updated successfully.');
    }

    public function destroy(SubBusinessUnit $subBusinessUnit)
    {
        $subBusinessUnit->delete();
        return redirect()->route('sub-business-units.index')->with('success', 'Sub business unit deleted successfully.');
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
            if (count($row) < 1 || empty($row[0])) continue; // Skip empty rows

            // Assuming typical header sequence based on the fields:
            // Sub Business Unit Name
            $sub_business_unit_name = isset($row[0]) ? trim($row[0]) : null;

            if ($sub_business_unit_name) {
                SubBusinessUnit::updateOrCreate(
                    ['sub_business_unit_name' => $sub_business_unit_name],
                    [
                        'status' => true,
                    ]
                );
                $imported++;
            }
        }

        return redirect()->route('sub-business-units.index')->with('success', "{$imported} sub business units imported successfully.");
    }
}
