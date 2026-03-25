<?php

namespace App\Http\Controllers;

use App\Models\JobFunction;
use Illuminate\Http\Request;

class JobFunctionController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $jobFunctions = JobFunction::when($search, function ($query) use ($search) {
            $query->where('function_name', 'like', "%{$search}%")
                  ->orWhere('function_code', 'like', "%{$search}%");
        })->latest()->paginate(10)->withQueryString();

        return view('job-functions.index', compact('jobFunctions', 'search'));
    }

    public function create()
    {
        return view('job-functions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'function_name' => 'required|string|max:255|unique:job_functions,function_name',
            'function_code' => 'nullable|string|max:50',
            'description'   => 'nullable|string',
            'status'        => 'boolean',
        ]);

        JobFunction::create([
            'function_name' => $request->function_name,
            'function_code' => $request->function_code,
            'description'   => $request->description,
            'status'        => $request->has('status') ? (bool) $request->status : true,
        ]);

        return redirect()->route('job-functions.index')
                         ->with('success', 'Function created successfully.');
    }

    public function edit(JobFunction $jobFunction)
    {
        return view('job-functions.edit', compact('jobFunction'));
    }

    public function update(Request $request, JobFunction $jobFunction)
    {
        $request->validate([
            'function_name' => 'required|string|max:255|unique:job_functions,function_name,' . $jobFunction->id,
            'function_code' => 'nullable|string|max:50',
            'description'   => 'nullable|string',
            'status'        => 'boolean',
        ]);

        $jobFunction->update([
            'function_name' => $request->function_name,
            'function_code' => $request->function_code,
            'description'   => $request->description,
            'status'        => $request->has('status') ? (bool) $request->status : false,
        ]);

        return redirect()->route('job-functions.index')
                         ->with('success', 'Function updated successfully.');
    }

    public function destroy(JobFunction $jobFunction)
    {
        $jobFunction->delete();
        return redirect()->route('job-functions.index')
                         ->with('success', 'Function deleted successfully.');
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

            $function_name = isset($row[0]) ? trim($row[0]) : null;
            $function_code = isset($row[1]) ? trim($row[1]) : null;
            $description    = isset($row[2]) ? trim($row[2]) : null;

            if ($function_name) {
                JobFunction::updateOrCreate(
                    ['function_name' => $function_name],
                    [
                        'function_code' => $function_code,
                        'description'    => $description,
                        'status'         => true,
                    ]
                );
                $imported++;
            }
        }

        return redirect()->route('job-functions.index')
                         ->with('success', "{$imported} functions imported successfully.");
    }

    public function downloadTemplate()
    {
        $headers  = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="job_functions_template.csv"'
        ];
        $callback = function () {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['Function Name', 'Function Code', 'Description']);
            fputcsv($handle, ['IT', 'IT01', 'Information Technology']);
            fputcsv($handle, ['Accounts', 'ACC', 'Accounting and Finance']);
            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }
}
