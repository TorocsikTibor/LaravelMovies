<?php

namespace App\Repositories;

use App\Models\Watchlist;

class WatchlistRepository
{
    public function getWatchlist()
    {
        return Watchlist::with('movies')->get();
    }

    public function getUserWatchlist(int $id)
    {
        return Watchlist::with('movies')->where('creator_user_id', $id)
            ->orWhereHas('users', function ($query) use ($id) {
                $query->where('user_id', $id);
            })->get();
    }

    public function create(array $validated)
    {
        return Watchlist::create([
            'name' => $validated['name'],
            'creator_user_id' => $validated['userId'],
        ]);
    }
}
