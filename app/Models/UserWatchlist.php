<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class UserWatchlist extends Pivot
{
    use HasFactory;
    protected $fillable = ['watchlist_id', 'user_id', 'permission_type'];
    protected $table = 'user_watchlist';
    public $timestamps = false;

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function watchlists(): BelongsTo
    {
        return $this->belongsTo(Watchlist::class);
    }
}
