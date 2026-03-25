<?php

namespace App\Http\Controllers;

use App\Models\EmployeeType;
use Illuminate\Http\Request;

class EmployeeTypeController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $employeeTypes = EmployeeType::when($search, function ($query) use ($search) {
            $query->where('type_name', 'like', "%{$search}%")
                  ->orWhere('type_code', 'like', "%{$search}%");
        })->latest()->paginate(10)->withQueryString();

        return view('employee-types.index', compact('employeeTypes', 'search'));
    }

    public function create()
    {
        return view('employee-types.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type_code'   => 'nullable|string|max:50',
            'type_name'   => 'required|string|max:255',
            'description' => 'nullable|string',
            'status'      => 'boolean',
        ]);

        EmployeeType::create([
            'type_code'   => $request->type_code,
            'type_name'   => $request->type_name,
            'description' => $request->description,
            'status'      => $request->has('status') ? (bool) $request->status : true,
        ]);

        return redirect()->route('employee-types.index')
                         ->with('success', 'Employee type created successfully.');
    }

    public function edit(EmployeeType $employeeType)
    {
        return view('employee-types.edit', compact('employeeType'));
    }

    public function update(Request $request, EmployeeType $employeeType)
    {
        $request->validate([
            'type_code'   => 'nullable|string|max:50',
            'type_name'   => 'required|string|max:255',
            'description' => 'nullable|string',
            'status'      => 'boolean',
        ]);

        $employeeType->update([
            'type_code'   => $request->type_code,
            'type_name'   => $request->type_name,
            'description' => $request->description,
            'status'      => $request->has('status') ? (bool) $request->status : false,
        ]);

        return redirect()->route('employee-types.index')
                         ->with('success', 'Employee type updated successfully.');
    }

    public function destroy(EmployeeType $employeeType)
    {
        $employeeType->delete();
        return redirect()->route('employee-types.index')
                         ->with('success', 'Employee type deleted successfully.');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt|max:2048',
        ]);

        $file    = $request->file('file');
        $csvData = file_get_contents($file);
        $rows    = array_map('str_getcsv', explode("\n", $csvData));
        array_shift($rows); // remove header

        $imported = 0;
        foreach ($rows as $row) {
            if (count($row) < 1 || empty($row[0])) continue;

            $type_name   = isset($row[0]) ? trim($row[0]) : null;
            $type_code   = isset($row[1]) ? trim($row[1]) : null;
            $description = isset($row[2]) ? trim($row[2]) : null;

            if ($type_name) {
                EmployeeType::updateOrCreate(
                    ['type_name' => $type_name],
                    [
                        'type_code'   => $type_code,
                        'description' => $description,
                        'status'      => true,
                    ]
                );
                $imported++;
            }
        }

        return redirect()->route('employee-types.index')
                         ->with('success', "{$imported} employee types imported successfully.");
    }

    public function downloadTemplate()
    {
        $headers  = ['Content-Type' => 'text/csv',
                     'Content-Disposition' => 'attachment; filename="employee_types_template.csv"'];
        $callback = function () {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['Type Name', 'Type Code', 'Description']);
            fputcsv($handle, ['Permanent', 'PERM', 'Full-time permanent employee']);
            fputcsv($handle, ['Probation', 'PROB', 'Probationary period employee']);
            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }
}
