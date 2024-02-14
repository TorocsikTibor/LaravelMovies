<?php

namespace App\Repositories;

use App\Models\MovieWatchlist;

class MovieWatchlistRepository
{
    public function checkWatchlist(array $validated)
    {
        return MovieWatchlist::where('watchlist_id', $validated['watchlistId'])->where('movie_id', $validated['movieId'])->get();
    }

    public function create(array $validated)
    {
        return MovieWatchlist::create([
            'watchlist_id' => $validated['watchlistId'],
            'movie_id' => $validated['movieId'],
        ]);
    }

    public function delete(int $watchlistId, int $movieId)
    {
        return MovieWatchlist::where('watchlist_id', $watchlistId)->where('movie_id', $movieId)->delete();
    }
}
