<?php

namespace App\Http\Controllers;

use App\Models\SubFunction;
use App\Models\User;
use Illuminate\Http\Request;

class SubFunctionController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $subFunctions = SubFunction::with('head')
            ->when($search, function ($query) use ($search) {
                $query->where('sub_function_name', 'like', "%{$search}%")
                      ->orWhere('sub_function_code', 'like', "%{$search}%");
            })->latest()->paginate(10)->withQueryString();

        return view('sub-functions.index', compact('subFunctions', 'search'));
    }

    public function create()
    {
        $users = User::all();
        return view('sub-functions.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'sub_function_name' => 'required|string|max:255|unique:sub_functions,sub_function_name',
            'sub_function_code' => 'nullable|string|max:50',
            'head_id'           => 'nullable|exists:users,id',
            'status'            => 'boolean',
        ]);

        SubFunction::create([
            'sub_function_name' => $request->sub_function_name,
            'sub_function_code' => $request->sub_function_code,
            'head_id'           => $request->head_id,
            'status'            => $request->has('status') ? (bool) $request->status : true,
        ]);

        return redirect()->route('sub-functions.index')
                         ->with('success', 'Sub Function created successfully.');
    }

    public function edit(SubFunction $subFunction)
    {
        $users = User::all();
        return view('sub-functions.edit', compact('subFunction', 'users'));
    }

    public function update(Request $request, SubFunction $subFunction)
    {
        $request->validate([
            'sub_function_name' => 'required|string|max:255|unique:sub_functions,sub_function_name,' . $subFunction->id,
            'sub_function_code' => 'nullable|string|max:50',
            'head_id'           => 'nullable|exists:users,id',
            'status'            => 'boolean',
        ]);

        $subFunction->update([
            'sub_function_name' => $request->sub_function_name,
            'sub_function_code' => $request->sub_function_code,
            'head_id'           => $request->head_id,
            'status'            => $request->has('status') ? (bool) $request->status : false,
        ]);

        return redirect()->route('sub-functions.index')
                         ->with('success', 'Sub Function updated successfully.');
    }

    public function destroy(SubFunction $subFunction)
    {
        $subFunction->delete();
        return redirect()->route('sub-functions.index')
                         ->with('success', 'Sub Function deleted successfully.');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt|max:2048',
        ]);

        $file    = $request->file('file');
        $csvData = file_get_contents($file);
        $rows    = array_map('str_getcsv', explode("\n", $csvData));
        array_shift($rows);

        $imported = 0;
        foreach ($rows as $row) {
            if (count($row) < 1 || empty($row[0])) continue;

            $name = isset($row[0]) ? trim($row[0]) : null;
            $code = isset($row[1]) ? trim($row[1]) : null;

            if ($name) {
                SubFunction::updateOrCreate(
                    ['sub_function_name' => $name],
                    [
                        'sub_function_code' => $code,
                        'status'            => true,
                    ]
                );
                $imported++;
            }
        }

        return redirect()->route('sub-functions.index')
                         ->with('success', "{$imported} sub functions imported successfully.");
    }

    public function downloadTemplate()
    {
        $headers  = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="sub_functions_template.csv"'
        ];
        $callback = function () {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['Sub Function Name', 'Sub Function Code']);
            fputcsv($handle, ['IT Support', 'IT-S01']);
            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }
}
