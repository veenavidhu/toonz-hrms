<?php

namespace App\Http\Controllers;

use App\Models\Holiday;
use Illuminate\Http\Request;

class HolidayController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $holidays = Holiday::when($search, function ($query) use ($search) {
            $query->where('holiday_name', 'like', "%{$search}%");
        })->latest()->paginate(10)->withQueryString();

        return view('holidays.index', compact('holidays', 'search'));
    }

    public function create()
    {
        return view('holidays.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'holiday_name' => 'required|string|max:255',
            'holiday_date' => 'required|date',
            'is_mandatory' => 'required|boolean',
            'status'       => 'boolean',
        ]);

        Holiday::create([
            'holiday_name' => $request->holiday_name,
            'holiday_date' => $request->holiday_date,
            'is_mandatory' => $request->is_mandatory,
            'status'       => $request->has('status') ? (bool) $request->status : true,
        ]);

        return redirect()->route('holidays.index')
                         ->with('success', 'Holiday created successfully.');
    }

    public function edit(Holiday $holiday)
    {
        return view('holidays.edit', compact('holiday'));
    }

    public function update(Request $request, Holiday $holiday)
    {
        $request->validate([
            'holiday_name' => 'required|string|max:255',
            'holiday_date' => 'required|date',
            'is_mandatory' => 'required|boolean',
            'status'       => 'boolean',
        ]);

        $holiday->update([
            'holiday_name' => $request->holiday_name,
            'holiday_date' => $request->holiday_date,
            'is_mandatory' => $request->is_mandatory,
            'status'       => $request->has('status') ? (bool) $request->status : false,
        ]);

        return redirect()->route('holidays.index')
                         ->with('success', 'Holiday updated successfully.');
    }

    public function destroy(Holiday $holiday)
    {
        $holiday->delete();
        return redirect()->route('holidays.index')
                         ->with('success', 'Holiday deleted successfully.');
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
            $date = isset($row[1]) ? trim($row[1]) : null;
            $mandatory = isset($row[2]) ? (bool) trim($row[2]) : true;

            if ($name && $date) {
                Holiday::updateOrCreate(
                    ['holiday_name' => $name, 'holiday_date' => $date],
                    ['is_mandatory' => $mandatory, 'status' => true]
                );
                $imported++;
            }
        }

        return redirect()->route('holidays.index')
                         ->with('success', "{$imported} holidays imported successfully.");
    }

    public function downloadTemplate()
    {
        $headers = [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => 'attachment; filename="holidays_template.csv"',
        ];

        $callback = function () {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['Holiday Name', 'Holiday Date (YYYY-MM-DD)', 'Is Mandatory (1/0)']);
            fputcsv($file, ['New Year Day', '2026-01-01', '1']);
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
