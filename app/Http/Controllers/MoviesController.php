<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Watchlist;
use App\Services\MovieService;
use App\Services\SearchService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;

class MoviesController extends Controller
{
    protected SearchService $searchService;
    protected MovieService $movieService;

    public function __construct(SearchService $searchService, MovieService $movieService)
    {
        $this->searchService = $searchService;
        $this->movieService = $movieService;
    }

    public function index(): View|Application|Factory
    {
        $movies = Movie::all();
        $watchlist = Watchlist::all();

        return view('app', ['movies' => $movies, 'watchlist' => $watchlist]);
    }

    public function getSearchedMovies(string $search): JsonResponse
    {
        $getApiQuery = $this->searchService->getMovieDBApiQuery($search);
        $searchedMovie = Movie::where('title', 'LIKE', '%'.$search.'%')->get();

        if ($searchedMovie->isEmpty()) {
            $searchedMovie = $this->movieService->saveMovies($getApiQuery);
        }

        return response()->json([ 'addedMovies' => $searchedMovie]);
    }
}
