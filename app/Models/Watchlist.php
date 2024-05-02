<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Watchlist extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'creator_user_id'];
    protected $table = 'watchlists';

    public function movies(): BelongsToMany
    {
        return $this->belongsToMany(Movie::class)->using(MovieWatchlist::class)->with('users:id,name');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->using(UserWatchlist::class);
    }
}
