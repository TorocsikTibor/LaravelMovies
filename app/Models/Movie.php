<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Movie extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'poster_path',
        'overview',
        'release_date',
        'vote_average',
        'vote_count',
    ];
    protected $table = 'movies';

    public function watchlists(): BelongsToMany
    {
        return $this->belongsToMany(Watchlist::class)->using(MovieWatchlist::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->using(MovieUser::class);
    }

}
