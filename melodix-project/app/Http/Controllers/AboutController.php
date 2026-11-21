<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;

class AboutController extends Controller
{
    // public About page
    public function index()
    {
        return view('about', [
            'siteName' => SiteSetting::get('site_name', 'Melodix'),
            'tagline' => SiteSetting::get('tagline', ''),
            'aboutText' => SiteSetting::get('about_text', 'Melodix is a place to discover music, videos, artists and playlists.'),
            'contactEmail' => SiteSetting::get('contact_email', ''),
        ]);
    }
}
