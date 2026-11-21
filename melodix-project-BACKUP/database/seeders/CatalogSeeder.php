<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

// Owner: Member 1 (blue): artists, albums, songs, videos (fictional sample data)
// IDs rely on a fresh database: genres 1 Pop,2 Romantic,3 Rock,4 Hip Hop,5 Sufi,6 Classical,7 Folk,8 Dance
// languages 1 English,2 Hindi,3 Urdu,4 Punjabi,5 Tamil | countries 1 Pakistan,2 India,3 USA,4 UK
class CatalogSeeder extends Seeder
{
    public function run(): void
    {
        if (DB::table('artists')->exists()) {
            return;
        }

        $stamp = ['created_at' => now(), 'updated_at' => now()];

        DB::table('artists')->insert([
            ['name' => 'Aarav Sen',    'bio' => 'Singer-songwriter known for soft, late-night melodies.'] + $stamp,
            ['name' => 'Zoya Malik',   'bio' => 'Sufi and ghazal vocalist.'] + $stamp,
            ['name' => 'Kabir Rao',    'bio' => 'Folk singer, famous for wedding and Mayon songs.'] + $stamp,
            ['name' => 'Meher Ali',    'bio' => 'Punjabi dance-pop artist.'] + $stamp,
            ['name' => 'Leo Hartman',  'bio' => 'British pop and electronic producer.'] + $stamp,
            ['name' => 'Nina Cole',    'bio' => 'American pop singer.'] + $stamp,
        ]);

        DB::table('albums')->insert([
            ['title' => 'Midnight Raag', 'artist_id' => 1, 'release_year' => 2023] + $stamp,
            ['title' => 'Sufi Nights',   'artist_id' => 2, 'release_year' => 2022] + $stamp,
            ['title' => 'Neon City',     'artist_id' => 5, 'release_year' => 2024] + $stamp,
            ['title' => 'Golden Hour',   'artist_id' => 6, 'release_year' => 2021] + $stamp,
        ]);

        // title, artist, album, genre, language, country, year, description, days ago
        $songs = [
            ['Raat Ka Safar',   1, 1,    2, 2, 2, 2023, 'A slow night-drive romantic track.', 1],
            ['Dil Ki Baat',     1, 1,    1, 2, 2, 2023, 'Upbeat Hindi pop.', 3],
            ['Noor-e-Ishq',     2, 2,    5, 3, 1, 2022, 'Sufi devotional.', 5],
            ['Khamoshi',        2, 2,    2, 3, 1, 2022, 'A quiet, sad ghazal.', 20],
            ['Mehndi Raat',     3, null, 7, 4, 1, 2020, 'Traditional Mayon night song.', 30],
            ['Shaadi Wali Dhun', 4, null, 8, 4, 2, 2019, 'Wedding dance favourite.', 40],
            ['Neon Lights',     5, 3,    1, 1, 4, 2024, 'Synth-pop single.', 2],
            ['City After Dark', 5, 3,    8, 1, 4, 2024, 'Club remix style track.', 4],
            ['Golden Hour',     6, 4,    1, 1, 3, 2021, 'Warm acoustic pop.', 60],
            ['Slow Rain',       6, 4,    2, 1, 3, 2021, 'Slow romantic ballad.', 90],
        ];
        DB::table('songs')->insert(array_map(fn ($s) => [
            'title' => $s[0], 'artist_id' => $s[1], 'album_id' => $s[2], 'genre_id' => $s[3],
            'language_id' => $s[4], 'country_id' => $s[5], 'release_year' => $s[6], 'description' => $s[7],
            'created_at' => now()->subDays($s[8]), 'updated_at' => now(),
        ], $songs));

        // title, type, artist, song, genre, language, country, year, description, days ago
        $videos = [
            ['Raat Ka Safar - Official Video',          'music_video',  1, 1, 2, 2, 2, 2023, 'Official music video.', 1],
            ['Noor-e-Ishq - Live Session',              'live_session', 2, 3, 5, 3, 1, 2022, 'Live studio performance.', 6],
            ['Shaadi Wali Dhun - Wedding Choreography', 'choreography', 4, 6, 8, 4, 2, 2019, 'Sangeet dance steps.', 15],
            ['Neon Lights - Official Video',            'music_video',  5, 7, 1, 1, 4, 2024, 'Official video.', 2],
            ['Dil Ki Baat - Film Version',              'movie_song',   1, 2, 1, 2, 2, 2023, 'Song as shown in the film.', 10],
            ['City After Dark - Dance Choreography',    'choreography', 5, 8, 8, 1, 4, 2024, 'Dance routine.', 8],
        ];
        DB::table('videos')->insert(array_map(fn ($v) => [
            'title' => $v[0], 'video_type' => $v[1], 'artist_id' => $v[2], 'song_id' => $v[3], 'genre_id' => $v[4],
            'language_id' => $v[5], 'country_id' => $v[6], 'release_year' => $v[7], 'description' => $v[8],
            'created_at' => now()->subDays($v[9]), 'updated_at' => now(),
        ], $videos));
    }
}
