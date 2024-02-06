<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Watchlist extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'creator_user_id'];
    protected $table = 'watchlists';

    public function movies(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Movie::class)->using(MovieWatchlist::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->using(UserWatchlist::class);
    }
}
