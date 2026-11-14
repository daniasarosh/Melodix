<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Song;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    // saari languages ki list (add form isi page par hai)
    public function index()
    {
        $languages = Language::orderBy('name')->get();
        return view('admin.languages.index', compact('languages'));
    }

    // nayi language save karta hai
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:60|unique:languages,name',
        ]);

        $language = new Language();
        $language->name = $request->name;
        $language->save();

        return redirect()->route('admin.languages.index')->with('success', 'Language added.');
    }

    // edit ka form
    public function edit(Language $language)
    {
        return view('admin.languages.edit', compact('language'));
    }

    // edit submit hone par update karta hai
    public function update(Request $request, Language $language)
    {
        $request->validate([
            'name' => 'required|max:60|unique:languages,name,' . $language->id,
        ]);

        $language->name = $request->name;
        $language->save();

        return redirect()->route('admin.languages.index')->with('success', 'Language updated.');
    }

    // language delete karta hai
    public function destroy(Language $language)
    {
        if (Song::where('language_id', $language->id)->count() > 0) {
            return back()->with('error', 'Some songs use this language. Change or remove them first.');
        }

        try {
            $language->delete();
        } catch (QueryException $e) {
            return back()->with('error', 'This language is still in use, so it cannot be deleted.');
        }

        return redirect()->route('admin.languages.index')->with('success', 'Language deleted.');
    }
}