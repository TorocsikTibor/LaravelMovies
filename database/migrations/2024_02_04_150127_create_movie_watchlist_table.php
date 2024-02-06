<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('movie_watchlist', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('watchlist_id');
            $table->unsignedBigInteger('movie_id');
            $table->foreign('watchlist_id')->references('id')->on('watchlists')->onDelete('cascade');
            $table->foreign('movie_id')->references('id')->on('movies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movie_watchlist');
    }
};
