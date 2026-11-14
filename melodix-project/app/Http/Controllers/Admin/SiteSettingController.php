<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class SiteSettingController extends Controller
{
    private $keys = ['site_name', 'tagline', 'about_text', 'contact_email'];

    // site information ka form
    public function edit()
    {
        $settings = [
            'site_name' => SiteSetting::get('site_name', 'Melodix'),
            'tagline' => SiteSetting::get('tagline', ''),
            'about_text' => SiteSetting::get('about_text', 'Melodix is a place to discover music, videos, artists and playlists.'),
            'contact_email' => SiteSetting::get('contact_email', ''),
        ];

        return view('admin.settings.edit', compact('settings'));
    }

    // form submit hone par save karta hai
    public function update(Request $request)
    {
        $request->validate([
            'site_name' => 'required|max:50',
            'tagline' => 'nullable|max:150',
            'about_text' => 'required|max:3000',
            'contact_email' => 'nullable|email|max:100',
        ]);

        foreach ($this->keys as $key) {
            SiteSetting::updateOrCreate(
                ['setting_key' => $key],
                ['setting_value' => $request->input($key) ?? '']
            );
        }

        return back()->with('success', 'Site information updated.');
    }
}
