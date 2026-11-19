<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        // Pull values from Member 1's site_settings table
        $siteName = SiteSetting::get('site_name', 'Melodix');
        $tagline = SiteSetting::get('tagline', 'Feel the Music');
        $aboutText = SiteSetting::get('about_text', 'Melodix is a music and music-video platform by SOUND Group.');
        $contactEmail = SiteSetting::get('contact_email', 'support@melodix.com');

        return view('about', compact('siteName', 'tagline', 'aboutText', 'contactEmail'));
    }
}