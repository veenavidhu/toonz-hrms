<?php

namespace App\Http\Controllers;

use App\Models\Designation;
use Illuminate\Http\Request;

class DesignationController extends Controller
{
    public function index()
    {
        $designations = Designation::latest()->paginate(10);
        return view('designations.index', compact('designations'));
    }

    public function create()
    {
        return view('designations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'designation_code' => 'nullable|string|max:50',
            'designation_name' => 'required|string|max:255',
            'about_designation' => 'nullable|string',
            'status' => 'boolean',
        ]);

        Designation::create($request->all());

        return redirect()->route('designations.index')->with('success', 'Designation created successfully.');
    }

    public function edit(Designation $designation)
    {
        return view('designations.edit', compact('designation'));
    }

    public function update(Request $request, Designation $designation)
    {
        $request->validate([
            'designation_code' => 'nullable|string|max:50',
            'designation_name' => 'required|string|max:255',
            'about_designation' => 'nullable|string',
            'status' => 'boolean',
        ]);

        $designation->update($request->all());

        return redirect()->route('designations.index')->with('success', 'Designation updated successfully.');
    }

    public function destroy(Designation $designation)
    {
        $designation->delete();
        return redirect()->route('designations.index')->with('success', 'Designation deleted successfully.');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt|max:2048',
        ]);

        $file = $request->file('file');
        $csvData = file_get_contents($file);
        $rows = array_map('str_getcsv', explode("\n", $csvData));
        $header = array_shift($rows);

        $imported = 0;
        foreach ($rows as $row) {
            if (count($row) < 1 || empty($row[0])) continue;

            $designation_name = isset($row[0]) ? trim($row[0]) : null;
            $designation_code = isset($row[1]) ? trim($row[1]) : null;
            $about_designation = isset($row[2]) ? trim($row[2]) : null;

            if ($designation_name) {
                Designation::updateOrCreate(
                    ['designation_name' => $designation_name],
                    [
                        'designation_code' => $designation_code,
                        'about_designation' => $about_designation,
                        'status' => true,
                    ]
                );
                $imported++;
            }
        }

        return redirect()->route('designations.index')->with('success', "{$imported} designations imported successfully.");
    }
}
