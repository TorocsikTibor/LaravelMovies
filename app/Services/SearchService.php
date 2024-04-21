<?php

namespace App\Services;

use App\Repositories\SearchRepository;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class SearchService
{
    private SearchRepository $searchRepository;

    public function __construct(SearchRepository $searchRepository)
    {
        $this->searchRepository = $searchRepository;
    }

    public function getMovieGenres(): mixed
    {
        $genresFromApi = Http::get('https://api.themoviedb.org/3/genre/movie/list?api_key=bbcb1b887ed061963a75585825124fcf&language=en'); // api_key=bbcb1b887ed061963a75585825124fcf

        return json_decode($genresFromApi);
    }

    public function getMovieDBApiQuery(string $searchValue): mixed
    {
        $movieResponse = Http::get('https://api.themoviedb.org/3/search/movie?api_key=bbcb1b887ed061963a75585825124fcf&query=' . $searchValue); // api_key=bbcb1b887ed061963a75585825124fcf

        return $movieResponse->json();
    }

    public function getApiPoster(string $posterName): Response
    {
        return Http::get('https://image.tmdb.org/t/p/w500'. $posterName);
    }

    public function searchInTitle(string $searchValue)
    {
        return $this->searchRepository->searchInTitle($searchValue);
    }

    public function countSearchInTitle(string $searchValue)
    {
        return $this->searchRepository->countSearchintitle($searchValue);
    }

}
