<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    public function manga() {
        return $this->belongsToMany('App\Manga', 'manga_genres', 'genre_id', 'manga_id');
    }
}