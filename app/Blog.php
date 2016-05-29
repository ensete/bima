<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected  $guarded = [];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function images() {
        return $this->hasMany('App\Image', 'target_id');
    }

    public function scopeProminentPosts($query, $limit) {
        return $query->orderBy('views', 'desc')->limit($limit)->get();
    }

}
