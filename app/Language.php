<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    public function manga() {
        return $this->belongsToMany('App\Manga', 'manga_languages', 'language_id', 'manga_id');
    }
}
