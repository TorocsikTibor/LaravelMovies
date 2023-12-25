<?php

namespace Database\Seeders;

use App\Services\SearchService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(SearchService $searchService): void
    {
        $decodedGenres = $searchService->getMovieGenres();

        foreach ($decodedGenres->genres as $genre) {
            DB::table('genres')->insert([
                'name' => $genre->name,
            ]);
        }

    }
}
