<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TextField extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function scopeOfLanguage($query, $language_id) {
        return $query->where('language_id', $language_id)->get();
    }
}
