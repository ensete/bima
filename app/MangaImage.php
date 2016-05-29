<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MangaImage extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function texts() {
        return $this->hasMany('App\TextField', 'image_id');
    }
}
