<?php

namespace App\Http\Controllers;

use App\Models\MovieWatchlist;
use App\Models\User;
use App\Models\UserWatchlist;
use App\Models\Watchlist;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WatchlistController extends Controller
{
    public function getWatchlist()
    {
        return response()->json(Watchlist::with('movies')->get());
    }

    public function create(Request $request): JsonResponse
    {
        $name = $request->input('name');
        $userId = $request->input('userId');

        $watchlist = Watchlist::create([
           'name' =>  $name,
            'creator_user_id' => $userId,
        ]);

        return response()->json($watchlist);
    }

    public function addMovie(Request $request)
    {
        $watchListId = $request->input('watchlistId');
        $movieId = $request->input('movieId');

        $watchlistCheck = MovieWatchlist::where('watchlist_id', $watchListId)->where('movie_id', $movieId)->get();
        if ($watchlistCheck->isEmpty()) {
            $addMovie = MovieWatchlist::create([
                'watchlist_id' => $watchListId,
                'movie_id' => $movieId,
            ]);

            return response()->json($addMovie);
        }

        return response()->json("Already added.");
    }

    public function addCollaborator(Request $request)
    {
        $email = $request->input('email');
        $watchlistId = $request->input('watchlistId');

        $userId = User::where('email', $email)->first('id');


        $addCollaborator = UserWatchlist::create([
            'watchlist_id' => $watchlistId,
            'user_id' => $userId['id'],
            'permission_type' => 2,
        ]);

        return response()->json($addCollaborator);
    }

    public function addMember(Request $request)
    {
        $email = $request->input('email');
        $watchlistId = $request->input('watchlistId');

        $userId = User::where('email', $email)->first('id');


        $addCollaborator = UserWatchlist::create([
            'watchlist_id' => $watchlistId,
            'user_id' => $userId['id'],
            'permission_type' => 1,
        ]);

        return response()->json($addCollaborator);
    }
}
