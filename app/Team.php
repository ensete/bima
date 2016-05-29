<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{

    public function users() {
        return $this->hasMany('App\User');
    }

    public function manga() {
        return $this->hasMany('App\Manga');
    }
}
