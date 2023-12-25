<?php

namespace App\Services;

use App\Models\Genre;
use App\Models\Movie;
use App\Models\MovieGenre;
use Illuminate\Support\Facades\Storage;

class MovieService
{
    protected SearchService $searchService;

    public function __construct(SearchService $searchService)
    {
        $this->searchService = $searchService;
    }

    public function saveMovies(mixed $movieArray): array
    {
        $movies = $movieArray;
        $createdMovies = [];
        $firstThreeMovie = array_slice($movies['results'], 0, 3);

        foreach ($firstThreeMovie as $movie) {
            $saveMovie = Movie::updateOrCreate(
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

            if (isset($movie['poster_path'])) {
                $this->saveMovieImage($movie['poster_path']);
            }
            $movieGenres = $this->convertGenre($movie['genre_ids']);

            foreach ($movieGenres as $movieGenre) {
                $addGenre = new MovieGenre;
                $addGenre->movie_id = $saveMovie->id;
                $addGenre->genre_id = $movieGenre;
                $addGenre->save();
            }

            $createdMovies[] = $saveMovie;
        }

        return $createdMovies;
    }

    private function convertGenre(array $movieGenres): array
    {
        $apiGenres = $this->searchService->getMovieGenres();
        $apiGenres = collect($apiGenres->genres);
        $genres = Genre::all();
        $newGenreIds = [];

        foreach ($movieGenres as $movieGenre) {
                $apiGenreId = $apiGenres->firstwhere('id', $movieGenre);
                $convertedIds = $genres->firstWhere('name', $apiGenreId->name);
                $newGenreIds[] += $convertedIds->id;
        }

        return $newGenreIds;
    }

    public function saveMovieImage(string $posterPath): void
    {
        $poster = $this->searchService->getApiPoster($posterPath);
        $imageContent = $poster->body();
        $posterPath = ltrim($posterPath, "/");
//        $filename = date('YmdHis') . $posterPath;
        $filename = $posterPath;
        Storage::disk('public')->put($filename, $imageContent);
    }

}
