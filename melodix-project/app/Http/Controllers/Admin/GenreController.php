<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use App\Models\Song;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    // saari genres ki list (add form isi page par hai)
    public function index()
    {
        $genres = Genre::orderBy('name')->get();
        return view('admin.genres.index', compact('genres'));
    }

    // nayi genre save karta hai
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:60|unique:genres,name',
        ]);

        $genre = new Genre();
        $genre->name = $request->name;
        $genre->save();

        return redirect()->route('admin.genres.index')->with('success', 'Genre added.');
    }

    // edit ka form
    public function edit(Genre $genre)
    {
        return view('admin.genres.edit', compact('genre'));
    }

    // edit submit hone par update karta hai
    public function update(Request $request, Genre $genre)
    {
        $request->validate([
            'name' => 'required|max:60|unique:genres,name,' . $genre->id,
        ]);

        $genre->name = $request->name;
        $genre->save();

        return redirect()->route('admin.genres.index')->with('success', 'Genre updated.');
    }

    // genre delete karta hai
    public function destroy(Genre $genre)
    {
        if (Song::where('genre_id', $genre->id)->count() > 0) {
            return back()->with('error', 'Some songs use this genre. Change or remove them first.');
        }

        try {
            $genre->delete();
        } catch (QueryException $e) {
            return back()->with('error', 'This genre is still in use, so it cannot be deleted.');
        }

        return redirect()->route('admin.genres.index')->with('success', 'Genre deleted.');
    }
}
