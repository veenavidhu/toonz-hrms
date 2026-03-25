<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use App\Models\Location;
use App\Models\State;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $locations = Location::with(['country', 'state', 'city'])
            ->when($search, function ($query) use ($search) {
                $query->where('location_name', 'like', "%{$search}%")
                      ->orWhere('location_code', 'like', "%{$search}%");
            })->latest()->paginate(10)->withQueryString();

        return view('locations.index', compact('locations', 'search'));
    }

    public function create()
    {
        $countries = Country::all();
        $timezones = \DateTimeZone::listIdentifiers();
        return view('locations.create', compact('countries', 'timezones'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'location_name' => 'required|string|max:255',
            'country_id'    => 'required|exists:countries,id',
            'state_id'      => 'required|exists:states,id',
            'city_id'       => 'required|exists:cities,id',
            'status'        => 'required|boolean',
        ]);

        Location::create($request->all());

        return redirect()->route('locations.index')
                         ->with('success', 'Location created successfully.');
    }

    public function edit(Location $location)
    {
        $countries = Country::all();
        $states    = State::where('country_id', $location->country_id)->get();
        $cities    = City::where('state_id', $location->state_id)->get();
        $timezones = \DateTimeZone::listIdentifiers();
        
        return view('locations.edit', compact('location', 'countries', 'states', 'cities', 'timezones'));
    }

    public function update(Request $request, Location $location)
    {
        $request->validate([
            'location_name' => 'required|string|max:255',
            'country_id'    => 'required|exists:countries,id',
            'state_id'      => 'required|exists:states,id',
            'city_id'       => 'required|exists:cities,id',
            'status'        => 'required|boolean',
        ]);

        $location->update($request->all());

        return redirect()->route('locations.index')
                         ->with('success', 'Location updated successfully.');
    }

    public function destroy(Location $location)
    {
        $location->delete();
        return redirect()->route('locations.index')
                         ->with('success', 'Location deleted successfully.');
    }

    public function getStatesByCountry($country_id)
    {
        $states = State::where('country_id', $country_id)->get();
        return response()->json($states);
    }

    public function getCitiesByState($state_id)
    {
        $cities = City::where('state_id', $state_id)->get();
        return response()->json($cities);
    }

    public function getStates(Request $request)
    {
        $states = State::where('country_id', $request->country_id)->get();
        return response()->json($states);
    }

    public function getCities(Request $request)
    {
        $cities = City::where('state_id', $request->state_id)->get();
        return response()->json($cities);
    }
}
