<?php

namespace App\Repositories;

use App\Models\UserWatchlist;

class UserWatchlistRepository
{
    public function create(int $watchlistId, int $userId, int $memberType)
    {
        return UserWatchlist::create([
            'watchlist_id' => $watchlistId,
            'user_id' => $userId,
            'permission_type' => $memberType,
        ]);
    }
}
