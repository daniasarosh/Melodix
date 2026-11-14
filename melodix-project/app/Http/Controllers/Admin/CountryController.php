<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    // saare countries ki list (add form isi page par hai)
    public function index()
    {
        $countries = Country::orderBy('name')->get();
        return view('admin.countries.index', compact('countries'));
    }

    // naya country save karta hai
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:60|unique:countries,name',
        ]);

        $country = new Country();
        $country->name = $request->name;
        $country->save();

        return redirect()->route('admin.countries.index')->with('success', 'Country added.');
    }

    // edit ka form
    public function edit(Country $country)
    {
        return view('admin.countries.edit', compact('country'));
    }

    // edit submit hone par update karta hai
    public function update(Request $request, Country $country)
    {
        $request->validate([
            'name' => 'required|max:60|unique:countries,name,' . $country->id,
        ]);

        $country->name = $request->name;
        $country->save();

        return redirect()->route('admin.countries.index')->with('success', 'Country updated.');
    }

    // country delete karta hai
    public function destroy(Country $country)
    {
        try {
            $country->delete();
        } catch (QueryException $e) {
            return back()->with('error', 'This country is still in use, so it cannot be deleted.');
        }

        return redirect()->route('admin.countries.index')->with('success', 'Country deleted.');
    }
}