<?php

namespace App\Http\Controllers;

use App\Models\Movie;
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
        return view('app');
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
