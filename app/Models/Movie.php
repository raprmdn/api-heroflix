<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = ['title', 'slug', 'track_id', 'description',
        'age_restricted', 'release_year', 'season',
        'genre', 'thumbnail', 'starring', 'director'];
}
