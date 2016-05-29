<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    public function scopeRandom($query, $rank_id = 1) {
        return $query->orderByRaw("RAND()")->where('rank_id', $rank_id)->first();
    }
}
