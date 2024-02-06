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
        Schema::create('user_watchlist', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('watchlist_id');
            $table->unsignedBigInteger('user_id');
            $table->integer('permission_type');
            $table->foreign('watchlist_id')->references('id')->on('watchlists')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_watchlist');
    }
};
