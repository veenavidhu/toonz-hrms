<?php

namespace App\Http\Controllers;

use App\Models\Qualification;
use Illuminate\Http\Request;

class QualificationController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $qualifications = Qualification::when($search, function ($query) use ($search) {
            $query->where('qualification_name', 'like', "%{$search}%");
        })->latest()->paginate(10)->withQueryString();

        return view('qualifications.index', compact('qualifications', 'search'));
    }

    public function create()
    {
        return view('qualifications.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'qualification_name' => 'required|string|max:255|unique:qualifications',
            'status'             => 'boolean',
        ]);

        Qualification::create([
            'qualification_name' => $request->qualification_name,
            'status'             => $request->has('status') ? (bool) $request->status : true,
        ]);

        return redirect()->route('qualifications.index')
                         ->with('success', 'Qualification created successfully.');
    }

    public function edit(Qualification $qualification)
    {
        return view('qualifications.edit', compact('qualification'));
    }

    public function update(Request $request, Qualification $qualification)
    {
        $request->validate([
            'qualification_name' => 'required|string|max:255|unique:qualifications,qualification_name,' . $qualification->id,
            'status'             => 'boolean',
        ]);

        $qualification->update([
            'qualification_name' => $request->qualification_name,
            'status'             => $request->has('status') ? (bool) $request->status : false,
        ]);

        return redirect()->route('qualifications.index')
                         ->with('success', 'Qualification updated successfully.');
    }

    public function destroy(Qualification $qualification)
    {
        $qualification->delete();
        return redirect()->route('qualifications.index')
                         ->with('success', 'Qualification deleted successfully.');
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

            $name = trim($row[0]);

            if ($name) {
                Qualification::updateOrCreate(
                    ['qualification_name' => $name],
                    ['status' => true]
                );
                $imported++;
            }
        }

        return redirect()->route('qualifications.index')
                         ->with('success', "{$imported} qualifications imported successfully.");
    }

    public function downloadTemplate()
    {
        $headers = [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => 'attachment; filename="qualifications_template.csv"',
        ];

        $callback = function () {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['Qualification Name']);
            fputcsv($file, ['Bachelor of Science']);
            fputcsv($file, ['Master of Business Administration']);
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
