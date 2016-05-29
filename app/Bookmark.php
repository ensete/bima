<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    protected $fillable = ['manga_id', 'user_id'];
    public $timestamps = false;

    public function manga() {
        return $this->belongsTo('App\Manga');
    }
}
