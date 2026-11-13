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
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('song_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('video_id')->nullable()->constrained()->cascadeOnDelete();
            $table->unsignedTinyInteger('rating');   // 1 to 5
            $table->timestamps();
            $table->unique(['user_id', 'song_id']);
            $table->unique(['user_id', 'video_id']);
        });

        DB::statement('ALTER TABLE ratings ADD CONSTRAINT chk_ratings_one CHECK ((song_id IS NULL) <> (video_id IS NULL))');
        DB::statement('ALTER TABLE ratings ADD CONSTRAINT chk_ratings_range CHECK (rating BETWEEN 1 AND 5)');
    }

    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};
