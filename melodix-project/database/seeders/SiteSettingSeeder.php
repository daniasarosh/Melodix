<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

// Owner: Member 1 (blue): text the admin can edit later (About page, home intro)
class SiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        if (DB::table('site_settings')->exists()) {
            return;
        }

        $settings = [
            'site_name'  => 'Melodix',
            'tagline'    => 'Modern. Musical. Timeless.',
            'home_intro' => 'Discover new and old songs and music videos in regional and English languages.',
            'about_text' => 'Melodix is a music and music-video platform by SOUND Group. Browse by artist, album, genre, language, country and year, build your own playlists, and share your reviews and ratings.',
        ];

        foreach ($settings as $key => $value) {
            DB::table('site_settings')->insert([
                'setting_key' => $key, 'setting_value' => $value,
                'created_at' => now(), 'updated_at' => now(),
            ]);
        }
    }
}
