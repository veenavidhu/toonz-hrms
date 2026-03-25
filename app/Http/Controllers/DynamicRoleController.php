<?php

namespace App\Http\Controllers;

use App\Models\DynamicRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DynamicRoleController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $dynamicRoles = DynamicRole::with('creator')
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('dynamic-roles.index', compact('dynamicRoles', 'search'));
    }

    public function create()
    {
        return view('dynamic-roles.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'effective_date' => 'required|date',
            'status' => 'required|boolean',
        ]);

        $validated['created_by'] = Auth::id();

        DynamicRole::create($validated);

        return redirect()->route('dynamic-roles.index')
            ->with('success', 'Dynamic Role created successfully.');
    }

    public function edit(DynamicRole $dynamicRole)
    {
        return view('dynamic-roles.edit', compact('dynamicRole'));
    }

    public function update(Request $request, DynamicRole $dynamicRole)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'effective_date' => 'required|date',
            'status' => 'required|boolean',
        ]);

        $dynamicRole->update($validated);

        return redirect()->route('dynamic-roles.index')
            ->with('success', 'Dynamic Role updated successfully.');
    }

    public function destroy(DynamicRole $dynamicRole)
    {
        $dynamicRole->delete();

        return redirect()->route('dynamic-roles.index')
            ->with('success', 'Dynamic Role deleted successfully.');
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

            $name = isset($row[0]) ? trim($row[0]) : null;
            $effective_date = isset($row[1]) ? trim($row[1]) : date('Y-m-d');
            $status = isset($row[2]) ? (bool)trim($row[2]) : true;

            if ($name) {
                DynamicRole::updateOrCreate(
                    ['name' => $name],
                    [
                        'effective_date' => $effective_date,
                        'status' => $status,
                        'created_by' => Auth::id(),
                    ]
                );
                $imported++;
            }
        }

        return redirect()->route('dynamic-roles.index')
            ->with('success', "{$imported} roles imported successfully.");
    }
}
