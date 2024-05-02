<?php

namespace App\Repositories;

use App\Models\MovieUser;

class MovieUserRepository
{
    public function create(int $movieId, int $userId)
    {
        return MovieUser::updateOrCreate([
            'movie_id' => $movieId,
            'user_id' => $userId
        ],
            []
        );
    }

    public function delete(int $movieId, int $userId)
    {
        return MovieUser::where('movie_id', $movieId)->where('user_id', $userId)->delete();;
    }
}
