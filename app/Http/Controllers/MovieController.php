<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Services\MovieService;
use App\Services\SearchService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;

class MovieController extends Controller
{
    private SearchService $searchService;
    private MovieService $movieService;

    public function __construct(SearchService $searchService, MovieService $movieService)
    {
        $this->searchService = $searchService;
        $this->movieService = $movieService;
    }

    public function index(): View|Application|Factory
    {
        return view('app');
    }

    public function getSearchedMovies(string $search): JsonResponse
    {
        $getApiQuery = $this->searchService->getMovieDBApiQuery($search);
        $countMovies =  $this->searchService->countSearchInTitle($search);
        $searchedMovie = $this->searchService->searchInTitle($search);
        if ($countMovies < 10) {
            $savedApiMovies = $this->movieService->saveMovies($getApiQuery);
            $searchedMovie = array_merge($searchedMovie, $savedApiMovies);
        }

        return response()->json([ 'addedMovies' => $searchedMovie]);
    }

    public function getAllMovie()
    {
        $movie = $this->movieService->getAllMovie();

        return response()->json($movie);
    }
}
