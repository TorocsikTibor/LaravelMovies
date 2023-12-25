<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovieGenre extends Model
{
    use HasFactory;
    protected $fillable = ['movie_id', 'genre_id'];
    protected $table = "movie_genre";
    public $timestamps = false;


}
