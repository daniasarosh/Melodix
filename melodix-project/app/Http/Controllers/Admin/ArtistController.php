<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArtistController extends Controller
{
    // saare artists ki list
    public function index()
    {
        $artists = Artist::orderBy('name')->get();
        return view('admin.artists.index', compact('artists'));
    }

    // naya artist add karne ka form
    public function create()
    {
        return view('admin.artists.create');
    }

    // form submit hone par artist save karta hai
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:100',
            'bio' => 'nullable|max:2000',
            'photo' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data['photo'] = $request->file('photo')->store('artists', 'public');

        Artist::create($data);

        return redirect()->route('admin.artists.index')->with('success', 'Artist added.');
    }

    // artist edit karne ka form
    public function edit(Artist $artist)
    {
        return view('admin.artists.edit', compact('artist'));
    }

    // edit form submit hone par update karta hai
    public function update(Request $request, Artist $artist)
    {
        $data = $request->validate([
            'name' => 'required|max:100',
            'bio' => 'nullable|max:2000',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            if ($artist->photo) {
                Storage::disk('public')->delete($artist->photo);
            }
            $data['photo'] = $request->file('photo')->store('artists', 'public');
        }

        $artist->update($data);

        return redirect()->route('admin.artists.index')->with('success', 'Artist updated.');
    }

    // artist delete karta hai
    public function destroy(Artist $artist)
    {
        if ($artist->albums()->count() > 0 || $artist->songs()->count() > 0 || $artist->videos()->count() > 0) {
            return back()->with('error', 'This artist still has albums, songs or videos. Remove them first.');
        }

        if ($artist->photo) {
            Storage::disk('public')->delete($artist->photo);
        }

        $artist->delete();

        return redirect()->route('admin.artists.index')->with('success', 'Artist deleted.');
    }
}
