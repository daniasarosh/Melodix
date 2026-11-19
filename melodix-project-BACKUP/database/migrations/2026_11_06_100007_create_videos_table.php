<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

// Owner: Member 1 (blue)
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->string('title', 150)->index();
            $table->enum('video_type', ['music_video', 'choreography', 'movie_song', 'live_session'])->default('music_video');
            $table->foreignId('artist_id')->constrained()->restrictOnDelete();
            $table->foreignId('song_id')->nullable()->constrained()->nullOnDelete();   // optional: the song this video belongs to
            $table->foreignId('genre_id')->constrained()->restrictOnDelete();
            $table->foreignId('language_id')->constrained()->restrictOnDelete();
            $table->foreignId('country_id')->nullable()->constrained()->nullOnDelete();
            $table->unsignedSmallInteger('release_year')->index();
            $table->string('thumbnail')->nullable();
            $table->string('video_source')->nullable();   // uploaded file path OR embed link
            $table->text('description')->nullable();
            $table->timestamps();
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('videos');
    }
};
