<?php

namespace App\Repositories;

use App\Models\MovieGenre;

class MovieGenreRepository
{
    public function create(int $movieId, int $genreId)
    {
        return MovieGenre::create([
            'movie_id' => $movieId,
            'genre_id' => $genreId,
        ]);
    }
}
