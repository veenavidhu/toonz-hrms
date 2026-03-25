<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\State;
use App\Models\Country;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $cities = City::with(['state', 'state.country'])
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%");
            })->latest()->paginate(10)->withQueryString();

        return view('cities.index', compact('cities', 'search'));
    }

    public function create()
    {
        $countries = Country::all();
        return view('cities.create', compact('countries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'       => 'required|string|max:255',
            'state_id'   => 'required|exists:states,id',
            'status'     => 'required|boolean',
        ]);

        City::create($request->all());

        return redirect()->route('cities.index')
                         ->with('success', 'City created successfully.');
    }

    public function edit(City $city)
    {
        $countries = Country::all();
        $states    = State::where('country_id', $city->state->country_id)->get();
        return view('cities.edit', compact('city', 'countries', 'states'));
    }

    public function update(Request $request, City $city)
    {
        $request->validate([
            'name'       => 'required|string|max:255',
            'state_id'   => 'required|exists:states,id',
            'status'     => 'required|boolean',
        ]);

        $city->update($request->all());

        return redirect()->route('cities.index')
                         ->with('success', 'City updated successfully.');
    }

    public function destroy(City $city)
    {
        $city->delete();
        return redirect()->route('cities.index')
                         ->with('success', 'City deleted successfully.');
    }

    public function import(Request $request)
    {
        $request->validate(['file' => 'required|mimes:csv,txt|max:2048']);
        $rows = array_map('str_getcsv', explode("\n", file_get_contents($request->file('file'))));
        array_shift($rows);

        $imported = 0;
        foreach ($rows as $row) {
            if (count($row) < 2 || empty($row[0])) continue;
            $state = State::where('name', trim($row[0]))->first();
            if ($state) {
                City::updateOrCreate(
                    ['name' => trim($row[1]), 'state_id' => $state->id],
                    ['status' => true]
                );
                $imported++;
            }
        }
        return redirect()->route('cities.index')->with('success', "{$imported} cities imported.");
    }

    public function getStatesByCountry($country_id)
    {
        $states = State::where('country_id', $country_id)->get();
        return response()->json($states);
    }
}
