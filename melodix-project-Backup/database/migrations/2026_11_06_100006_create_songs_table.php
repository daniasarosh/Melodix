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
        Schema::create('songs', function (Blueprint $table) {
            $table->id();
            $table->string('title', 150)->index();
            $table->foreignId('artist_id')->constrained()->restrictOnDelete();
            $table->foreignId('album_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('genre_id')->constrained()->restrictOnDelete();
            $table->foreignId('language_id')->constrained()->restrictOnDelete();
            $table->foreignId('country_id')->nullable()->constrained()->nullOnDelete();
            $table->unsignedSmallInteger('release_year')->index();
            $table->string('cover_image')->nullable();
            $table->string('audio_file')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();                  // created_at = date added -> drives the NEW badge
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('songs');
    }
};
