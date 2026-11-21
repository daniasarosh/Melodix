<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

// Owner: Member 2 (maroon): curated playlists (made by admin) + one sample user playlist
// Needs UserSeeder and CatalogSeeder to have run first.
class PlaylistSeeder extends Seeder
{
    public function run(): void
    {
        if (DB::table('playlists')->exists()) {
            return;
        }

        $demoId = DB::table('users')->where('username', 'demo')->value('id');
        $stamp  = ['created_at' => now(), 'updated_at' => now()];

        // playlist ids: 1 90s, 2 Romantic, 3 Pop Hits, 4 Wedding, 5 Mayon, 6 Sad, 7 Slow, 8 Remix, 9 demo's playlist
        DB::table('playlists')->insert([
            ['user_id' => null, 'name' => '90s',      'description' => 'Classics from the 90s.',          'is_curated' => true] + $stamp,
            ['user_id' => null, 'name' => 'Romantic', 'description' => 'Songs for the heart.',            'is_curated' => true] + $stamp,
            ['user_id' => null, 'name' => 'Pop Hits', 'description' => "Today's pop.",                    'is_curated' => true] + $stamp,
            ['user_id' => null, 'name' => 'Wedding',  'description' => 'Sangeet and shaadi favourites.',  'is_curated' => true] + $stamp,
            ['user_id' => null, 'name' => 'Mayon',    'description' => 'Mayon night songs.',              'is_curated' => true] + $stamp,
            ['user_id' => null, 'name' => 'Sad',      'description' => 'For quiet evenings.',             'is_curated' => true] + $stamp,
            ['user_id' => null, 'name' => 'Slow',     'description' => 'Take it easy.',                   'is_curated' => true] + $stamp,
            ['user_id' => null, 'name' => 'Remix',    'description' => 'Club-ready remixes.',             'is_curated' => true] + $stamp,
            ['user_id' => $demoId, 'name' => 'My Favourites', 'description' => 'Songs I replay.',         'is_curated' => false] + $stamp,
        ]);

        // [playlist_id, song_id, video_id]  (exactly one of song/video is filled)
        $items = [
            [2, 1, null], [2, 4, null], [2, 10, null],
            [3, 2, null], [3, 7, null], [3, 9, null],
            [4, 6, null], [4, null, 3],
            [5, 5, null],
            [6, 4, null], [7, 4, null], [7, 10, null],
            [8, 8, null], [8, null, 6],
            [9, 1, null], [9, 7, null], [9, null, 4],
        ];
        DB::table('playlist_items')->insert(array_map(fn ($i) => [
            'playlist_id' => $i[0], 'song_id' => $i[1], 'video_id' => $i[2],
            'created_at' => now(), 'updated_at' => now(),
        ], $items));
    }
}
