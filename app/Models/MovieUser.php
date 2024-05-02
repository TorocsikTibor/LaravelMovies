<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class MovieUser extends Pivot
{
    use HasFactory;

    protected $table = 'movie_user';
    protected $fillable = ['movie_id', 'user_id'];

    public function movies(): BelongsTo
    {
        return $this->belongsTo(Movie::class);
    }

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
