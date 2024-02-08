<?php

namespace App\Repositories;

use App\Models\Movie;

class SearchRepository
{
    public function searchInTitle(string $searchValue)
    {
        return Movie::where('title', 'LIKE', '%'.$searchValue.'%')->get();
    }
}
