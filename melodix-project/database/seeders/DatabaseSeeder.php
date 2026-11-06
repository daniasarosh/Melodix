<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

// Shared file. REPLACES Laravel's default DatabaseSeeder. Order matters (blue first, then maroon).
class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,          // Member 1
            LookupSeeder::class,        // Member 1
            CatalogSeeder::class,       // Member 1
            SiteSettingSeeder::class,   // Member 1
            PlaylistSeeder::class,      // Member 2
            ReviewRatingSeeder::class,  // Member 2
        ]);
    }
}
