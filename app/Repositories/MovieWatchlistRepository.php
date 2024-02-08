<?php

namespace App\Repositories;

use App\Models\MovieWatchlist;

class MovieWatchlistRepository
{
    public function checkWatchlist(array $validated)
    {
        return MovieWatchlist::where('watchlist_id', $validated['watchListId'])->where('movie_id', $validated['movieId'])->get();
    }

    public function create(array $validated)
    {
        return MovieWatchlist::create([
            'watchlist_id' => $validated['watchListId'],
            'movie_id' => $validated['movieId'],
        ]);
    }
}
