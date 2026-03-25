<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use Illuminate\Http\Request;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banks = Bank::latest()->paginate(10);
        return view('banks.index', compact('banks'));
    }

    public function create()
    {
        return view('banks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'bank_code' => 'required|unique:banks',
            'bank_name' => 'required',
            'ifsc_code' => 'required',
            'bank_type' => 'required|in:Salary,Reimbursement',
            'branch' => 'nullable',
            'micr_code' => 'nullable',
            'company_ifsc_code' => 'nullable',
            'company_micr_code' => 'nullable',
            'company_account_number' => 'nullable',
        ]);

        Bank::create($request->all());

        return redirect()->route('banks.index')->with('success', 'Financial institution registered successfully.');
    }

    public function edit(Bank $bank)
    {
        return view('banks.edit', compact('bank'));
    }

    public function update(Request $request, Bank $bank)
    {
        $request->validate([
            'bank_code' => 'required|unique:banks,bank_code,' . $bank->id,
            'bank_name' => 'required',
            'ifsc_code' => 'required',
            'bank_type' => 'required|in:Salary,Reimbursement',
            'branch' => 'nullable',
            'micr_code' => 'nullable',
            'company_ifsc_code' => 'nullable',
            'company_micr_code' => 'nullable',
            'company_account_number' => 'nullable',
        ]);

        $bank->update($request->all());

        return redirect()->route('banks.index')->with('success', 'Institution records updated successfully.');
    }

    public function destroy(Bank $bank)
    {
        $bank->delete();
        return redirect()->route('banks.index')->with('success', 'Bank deleted successfully.');
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
            if (count($row) < 3 || empty($row[0])) continue; // Skip empty rows

            // Assuming typical header sequence based on the fields:
            // Bank Code, Bank Name, Bank Branch, Bank IFSC Code, Bank MICR Code, Bank Type, Company IFSC Code, Company MICR Code, Company Account Number
            // Let's create an associative array if header is provided or map by fixed index
            
            // To be robust, let's map by index assuming the format follows the requested fields:
            $bank_code = isset($row[0]) ? trim($row[0]) : null;
            $bank_name = isset($row[1]) ? trim($row[1]) : null;
            $branch = isset($row[2]) ? trim($row[2]) : null;
            $ifsc_code = isset($row[3]) ? trim($row[3]) : null;
            $micr_code = isset($row[4]) ? trim($row[4]) : null;
            $bank_type = isset($row[5]) ? trim($row[5]) : 'Salary';
            $company_ifsc_code = isset($row[6]) ? trim($row[6]) : null;
            $company_micr_code = isset($row[7]) ? trim($row[7]) : null;
            $company_account_number = isset($row[8]) ? trim($row[8]) : null;

            if ($bank_code && $bank_name && $ifsc_code) {
                Bank::updateOrCreate(
                    ['bank_code' => $bank_code],
                    [
                        'bank_name' => $bank_name,
                        'branch' => $branch,
                        'ifsc_code' => $ifsc_code,
                        'micr_code' => $micr_code,
                        'bank_type' => in_array($bank_type, ['Salary', 'Reimbursement']) ? $bank_type : 'Salary',
                        'company_ifsc_code' => $company_ifsc_code,
                        'company_micr_code' => $company_micr_code,
                        'company_account_number' => $company_account_number,
                    ]
                );
                $imported++;
            }
        }

        return redirect()->route('banks.index')->with('success', "{$imported} banks imported successfully.");
    }
}
