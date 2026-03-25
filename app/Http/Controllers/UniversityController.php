<?php

namespace App\Http\Controllers;

use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UniversityController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $universities = University::with('creator')
            ->when($search, function ($query) use ($search) {
                $query->where('university_name', 'like', "%{$search}%")
                      ->orWhere('location', 'like', "%{$search}%");
            })->latest()->paginate(10)->withQueryString();

        return view('universities.index', compact('universities', 'search'));
    }

    public function create()
    {
        return view('universities.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'university_name' => 'required|string|max:255|unique:universities',
            'location'        => 'nullable|string|max:255',
            'status'          => 'boolean',
        ]);

        University::create([
            'university_name' => $request->university_name,
            'location'        => $request->location,
            'status'          => $request->has('status') ? (bool) $request->status : true,
            'created_by'      => Auth::id(),
        ]);

        return redirect()->route('universities.index')
                         ->with('success', 'University created successfully.');
    }

    public function edit(University $university)
    {
        return view('universities.edit', compact('university'));
    }

    public function update(Request $request, University $university)
    {
        $request->validate([
            'university_name' => 'required|string|max:255|unique:universities,university_name,' . $university->id,
            'location'        => 'nullable|string|max:255',
            'status'          => 'boolean',
        ]);

        $university->update([
            'university_name' => $request->university_name,
            'location'        => $request->location,
            'status'          => $request->has('status') ? (bool) $request->status : false,
        ]);

        return redirect()->route('universities.index')
                         ->with('success', 'University updated successfully.');
    }

    public function destroy(University $university)
    {
        $university->delete();
        return redirect()->route('universities.index')
                         ->with('success', 'University deleted successfully.');
    }

    public function downloadTemplate()
    {
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="university_import_template.csv"',
        ];

        $callback = function () {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['University Name', 'Location']); // Headers
            fputcsv($file, ['Example University', 'New York, USA']); // Sample Row
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:csv,txt|max:2048',
        ]);

        $file = $request->file('file');
        $handle = fopen($file->getRealPath(), 'r');
        
        // Skip header
        fgetcsv($handle);

        $imported = 0;
        $skipped = 0;

        while (($data = fgetcsv($handle)) !== false) {
            if (empty($data[0])) {
                $skipped++;
                continue;
            }

            University::updateOrCreate(
                ['university_name' => trim($data[0])],
                [
                    'location'   => isset($data[1]) ? trim($data[1]) : null,
                    'status'     => true,
                    'created_by' => Auth::id(),
                ]
            );
            $imported++;
        }

        fclose($handle);

        return redirect()->route('universities.index')
                         ->with('success', "Import completed. {$imported} universities imported, {$skipped} skipped.");
    }
}
