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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('song_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('video_id')->nullable()->constrained()->cascadeOnDelete();
            $table->text('review_text');
            $table->timestamps();
            $table->unique(['user_id', 'song_id']);
            $table->unique(['user_id', 'video_id']);
        });

        DB::statement('ALTER TABLE reviews ADD CONSTRAINT chk_reviews_one CHECK ((song_id IS NULL) <> (video_id IS NULL))');
    }

    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
