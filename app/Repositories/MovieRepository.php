<?php

namespace App\Repositories;

use App\Models\Movie;
use App\Models\MovieUser;


class MovieRepository
{
    public function getAll()
    {
        return Movie::orderBy('title', 'asc')->with('users:id,name')->paginate(20);
    }

    public function updateOrCreate(array $movie)
    {
        return Movie::updateOrCreate(
            [
                'title' => $movie['title'],
                'release_date' => $movie['release_date'],
            ],
            [
                'overview' => $movie['overview'],
                'poster_path' => ltrim($movie['poster_path'], "/"),
                'vote_average' => $movie['vote_average'],
                'vote_count' => $movie['vote_count'],
            ]
        );
    }
}
