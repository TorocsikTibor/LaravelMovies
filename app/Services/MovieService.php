<?php

namespace App\Services;

use App\Models\Genre;
use App\Models\Movie;
use App\Models\MovieGenre;
use App\Repositories\GenreRepository;
use App\Repositories\MovieGenreRepository;
use App\Repositories\MovieRepository;
use Illuminate\Support\Facades\Storage;

class MovieService
{
    private SearchService $searchService;
    private MovieRepository $movieRepository;
    private MovieGenreRepository $movieGenreRepository;
    private GenreRepository $genreRepository;


    public function __construct
    (
        SearchService $searchService,
        MovieRepository $movieRepository,
        MovieGenreRepository $movieGenreRepository,
        GenreRepository $genreRepository
    ) {
        $this->searchService = $searchService;
        $this->movieRepository = $movieRepository;
        $this->movieGenreRepository = $movieGenreRepository;
        $this->genreRepository = $genreRepository;
    }

    public function saveMovies(mixed $movieArray): array
    {
        $movies = $movieArray;

        $sortedMovies = collect($movies['results'])->sortByDesc('vote_count', SORT_NUMERIC)->values()->all();
        $createdMovies = [];
        $firstThreeMovie = array_slice($sortedMovies, 0, 3);

        foreach ($firstThreeMovie as $movie) {
            $saveMovie = $this->movieRepository->updateOrCreate($movie);

            if (isset($movie['poster_path'])) {
                $this->saveMovieImage($movie['poster_path']);
            }
            $movieGenres = $this->convertGenre($movie['genre_ids']);

            foreach ($movieGenres as $movieGenreId) {
                $this->movieGenreRepository->create($saveMovie->id, $movieGenreId);
            }

            $createdMovies[] = $saveMovie;
        }

        return $createdMovies;
    }

    private function convertGenre(array $movieGenres): array
    {
        $apiGenres = $this->searchService->getMovieGenres();
        $apiGenres = collect($apiGenres->genres);
        $genres = $this->genreRepository->getAll();
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

    public function getAllMovie()
    {
        return $this->movieRepository->getAll();
    }

}
