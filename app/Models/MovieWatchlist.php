<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class MovieWatchlist extends Pivot
{
    use HasFactory;
    protected $fillable = ['watchlist_id', 'movie_id'];
    protected $table = 'movie_watchlist';
    public $timestamps = false;

    public function movies(): BelongsTo
    {
        return $this->belongsTo(Movie::class);
    }

    public function watchlists(): BelongsTo
    {
        return $this->belongsTo(Watchlist::class);
    }
}
