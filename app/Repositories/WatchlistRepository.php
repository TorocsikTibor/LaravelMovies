<?php

namespace App\Repositories;

use App\Models\Watchlist;
use Illuminate\Database\Eloquent\Collection;

class WatchlistRepository
{
    public function getWatchlist(): Collection|array
    {
        return Watchlist::with('movies')->get();
    }

    public function getUserWatchlist(int $id): Collection|array
    {
        return Watchlist::with(['movies', 'users' => function ($query) use ($id) {
            $query->where('user_id', $id)->withPivot('permission_type');
        }])
            ->where('creator_user_id', $id)
            ->orWhereHas('users', function ($query) use ($id) {
                $query->where('user_id', $id);
            })
            ->get();
    }

    public function getPermissionUserWatchlist(int $id): Collection|array
    {
        return Watchlist::with('movies')->where('creator_user_id', $id)
            ->orWhereHas('users', function ($query) use ($id) {
                $query->where('user_id', $id)->where('permission_type', 2);
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
