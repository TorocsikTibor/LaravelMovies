<?php

namespace App\Services;

use App\Repositories\MovieWatchlistRepository;
use App\Repositories\UserRepository;
use App\Repositories\UserWatchlistRepository;
use App\Repositories\WatchlistRepository;

class WatchlistService
{
    private WatchlistRepository $watchlistRepository;
    private MovieWatchlistRepository $movieWatchlistRepository;
    private UserWatchlistRepository $userWatchlistRepository;
    private UserRepository $userRepository;

    public function __construct(WatchlistRepository $watchlistRepository, MovieWatchlistRepository $movieWatchlistRepository, UserWatchlistRepository $userWatchlistRepository, UserRepository $userRepository)
    {
        $this->watchlistRepository = $watchlistRepository;
        $this->movieWatchlistRepository = $movieWatchlistRepository;
        $this->userWatchlistRepository = $userWatchlistRepository;
        $this->userRepository = $userRepository;
    }

    public function getWatchlist(): \Illuminate\Database\Eloquent\Collection|array
    {
        return $this->watchlistRepository->getWatchlist();
    }

    public function getUserWatchlist(int $id): \Illuminate\Database\Eloquent\Collection|array
    {
        return $this->watchlistRepository->getUserWatchlist($id);
    }

    public function create(array $validated)
    {
        return $this->watchlistRepository->create($validated);
    }

    public function checkWatchlist(array $validated)
    {
        return $this->movieWatchlistRepository->checkWatchlist($validated);
    }

    public function createMovieWatchlist(array $validated)
    {
        return $this->movieWatchlistRepository->create($validated);
    }

    public function addMember(int $watchlistId, int $userId, int $memberType)
    {
        return $this->userWatchlistRepository->create($watchlistId, $userId, $memberType);
    }

    public function getUser($email)
    {
        return $this->userRepository->searchByEmail($email);
    }
}
