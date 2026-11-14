<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            LookupSeeder::class,
            CatalogSeeder::class,
            SiteSettingSeeder::class,
            PlaylistSeeder::class,
            ReviewRatingSeeder::class,
        ]);
    }
}
