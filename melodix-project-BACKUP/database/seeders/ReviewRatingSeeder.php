<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

// Owner: Member 2 (maroon): sample reviews and ratings by the demo user
class ReviewRatingSeeder extends Seeder
{
    public function run(): void
    {
        if (DB::table('reviews')->exists()) {
            return;
        }

        $demoId = DB::table('users')->where('username', 'demo')->value('id');
        $stamp  = ['created_at' => now(), 'updated_at' => now()];

        DB::table('reviews')->insert([
            ['user_id' => $demoId, 'song_id' => 1, 'video_id' => null, 'review_text' => 'Perfect for late drives. Love the vocals.'] + $stamp,
            ['user_id' => $demoId, 'song_id' => null, 'video_id' => 4, 'review_text' => 'Great visuals and a catchy tune.'] + $stamp,
        ]);

        DB::table('ratings')->insert([
            ['user_id' => $demoId, 'song_id' => 1, 'video_id' => null, 'rating' => 5] + $stamp,
            ['user_id' => $demoId, 'song_id' => 7, 'video_id' => null, 'rating' => 4] + $stamp,
            ['user_id' => $demoId, 'song_id' => null, 'video_id' => 4, 'rating' => 5] + $stamp,
        ]);
    }
}
