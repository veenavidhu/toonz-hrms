<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;

class StateController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $states = State::with('country')
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%");
            })->latest()->paginate(10)->withQueryString();

        return view('states.index', compact('states', 'search'));
    }

    public function create()
    {
        $countries = Country::all();
        return view('states.create', compact('countries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'       => 'required|string|max:255',
            'country_id' => 'required|exists:countries,id',
            'status'     => 'required|boolean',
        ]);

        State::create($request->all());

        return redirect()->route('states.index')
                         ->with('success', 'State created successfully.');
    }

    public function edit(State $state)
    {
        $countries = Country::all();
        return view('states.edit', compact('state', 'countries'));
    }

    public function update(Request $request, State $state)
    {
        $request->validate([
            'name'       => 'required|string|max:255',
            'country_id' => 'required|exists:countries,id',
            'status'     => 'required|boolean',
        ]);

        $state->update($request->all());

        return redirect()->route('states.index')
                         ->with('success', 'State updated successfully.');
    }

    public function destroy(State $state)
    {
        $state->delete();
        return redirect()->route('states.index')
                         ->with('success', 'State deleted successfully.');
    }

    public function import(Request $request)
    {
        $request->validate(['file' => 'required|mimes:csv,txt|max:2048']);
        $rows = array_map('str_getcsv', explode("\n", file_get_contents($request->file('file'))));
        array_shift($rows);

        $imported = 0;
        foreach ($rows as $row) {
            if (count($row) < 2 || empty($row[0])) continue;
            $country = Country::where('name', trim($row[0]))->first();
            if ($country) {
                State::updateOrCreate(
                    ['name' => trim($row[1]), 'country_id' => $country->id],
                    ['status' => true]
                );
                $imported++;
            }
        }
        return redirect()->route('states.index')->with('success', "{$imported} states imported.");
    }
}
