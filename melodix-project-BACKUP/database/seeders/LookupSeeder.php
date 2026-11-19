<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

// Owner: Member 1 (blue): genres, languages, countries
class LookupSeeder extends Seeder
{
    public function run(): void
    {
        if (DB::table('genres')->exists()) {
            return;
        }

        $sets = [
            'genres'    => ['Pop', 'Romantic', 'Rock', 'Hip Hop', 'Sufi', 'Classical', 'Folk', 'Dance'],
            'languages' => ['English', 'Hindi', 'Urdu', 'Punjabi', 'Tamil'],
            'countries' => ['Pakistan', 'India', 'USA', 'UK'],
        ];

        foreach ($sets as $table => $names) {
            DB::table($table)->insert(array_map(
                fn ($name) => ['name' => $name, 'created_at' => now(), 'updated_at' => now()],
                $names
            ));
        }
    }
}
