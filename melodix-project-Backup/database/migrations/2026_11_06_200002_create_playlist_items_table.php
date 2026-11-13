<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

// Owner: Member 2 (maroon)
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('playlist_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('playlist_id')->constrained()->cascadeOnDelete();
            $table->foreignId('song_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('video_id')->nullable()->constrained()->cascadeOnDelete();
            $table->timestamps();
            $table->unique(['playlist_id', 'song_id']);
            $table->unique(['playlist_id', 'video_id']);
        });

        // Exactly one of song_id / video_id must be filled (needs MySQL 8.0.16+ or MariaDB 10.2+ to be enforced)
        DB::statement('ALTER TABLE playlist_items ADD CONSTRAINT chk_pi_one CHECK ((song_id IS NULL) <> (video_id IS NULL))');
    }

    public function down(): void
    {
        Schema::dropIfExists('playlist_items');
    }
};
