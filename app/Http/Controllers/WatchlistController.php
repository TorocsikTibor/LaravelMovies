<?php

namespace App\Http\Controllers;

use App\Services\WatchlistService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WatchlistController extends Controller
{
    private WatchlistService $watchlistService;

    public function __construct(WatchlistService $watchlistService)
    {
        $this->watchlistService = $watchlistService;
    }

    public function getWatchlist(): JsonResponse
    {
        return response()->json($this->watchlistService->getWatchlist());
    }

    public function show(int $id): JsonResponse
    {
        return response()->json($this->watchlistService->getUserWatchlist($id));
    }

    public function getPermissionUserWatchlist(int $id): JsonResponse
    {
        return response()->json($this->watchlistService->getPermissionUserWatchlist($id));
    }

    public function create(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'userId' => 'required|numeric',
        ]);
        $validated = $validator->validated();
        $createdWatchlist = $this->watchlistService->create($validated);

        return response()->json($createdWatchlist);
    }

    public function addMovie(Request $request): JsonResponse
    {
//        $userId = $request->input('userId');
//        $checkUser = User::find($userId);


        $validator = Validator::make($request->all(), [
            'watchlistId' => 'required|numeric',
            'movieId' => 'required|numeric',
        ]);
        $validated = $validator->validated();

        $watchlistCheck = $this->watchlistService->checkWatchlist($validated);

        if ($watchlistCheck->isEmpty()) {
            $addMovie = $this->watchlistService->createMovieWatchlist($validated);

            return response()->json($addMovie);
        }

        return response()->json($validated);
    }

    public function addMember(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'watchlistId' => 'required|numeric',
            'memberType' => 'required|numeric',
        ]);
        $validated = $validator->validated();

        $userId = $this->watchlistService->getUser($validated['email']);


        $addMember = $this->watchlistService->addMember($validated['watchlistId'], $userId['id'], $validated['memberType']);

        return response()->json($addMember);
    }

    public function deleteFromList(int $watchlistId, int $movieId)
    {
        return response()->json($this->watchlistService->deleteFromList($watchlistId, $movieId));
    }
}
